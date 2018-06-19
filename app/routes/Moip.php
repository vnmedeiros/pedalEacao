<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Moip\Moip;
use Moip\Resource\Customer;
use Moip\Auth\BasicAuth;
use Moip\Resource\Orders;
use Moip\Resource\OrdersList;
use Moip\Helper\Filters;

$token = 'HBGJK1UQMVLCDFBP1JK74YVXJBUJFXFW';
$key = 'TBKNXRCSVGYQWNZPYHG9LKGTHGLR4VAYAE6LUU7E';

$moip = new Moip(new BasicAuth($token, $key), Moip::ENDPOINT_PRODUCTION);

$app->post('/moip/boleto', function (Request $request, Response $response) use($moip) {
    try {
        $data = $request->getParsedBody();
        $idInscricao = filter_var($data['idInscricao'], FILTER_SANITIZE_STRING);       
        
        $base = new EventoDAO($this->db);
        $inscricao = $base->getResume($idInscricao);
        
        $dd= substr(preg_replace("/[^0-9]/", "", $inscricao['celular']), 0, 2);
        $phone = substr(preg_replace("/[^0-9]/", "", $inscricao['celular']), 2, 11);
        $cpf = preg_replace("/[^0-9]/", "", $inscricao['CPF']);
        
        $customer = $moip->customers()->setOwnId(uniqid())
            ->setFullname($inscricao['nome'])
            ->setEmail($inscricao['email'])
            ->setBirthDate('1988-12-30')
            ->setTaxDocument($cpf, 'CPF')
            ->setPhone($dd, $phone)
            ->addAddress(Customer::ADDRESS_SHIPPING,
                $inscricao['logradouro'], 
                $inscricao['bairro'], $inscricao['cidade'], $inscricao['UF'],
                preg_replace("/[^0-9]/", "", $inscricao['cep']), 8)
            ->create();
        
        //$descricao = $inscricao['evento'].' ('.$inscricao['descricao'].')';
        $descricao = $inscricao['evento'];//.' ('.$inscricao['descricao'].')';
        $valor = $inscricao['valor'];
                
        $order = $moip->orders()->setOwnId(uniqid())
            ->addItem("$descricao - nº inscrição:$idInscricao", 1, $idInscricao, $valor * 100)
            ->setCustomer($customer)
            ->create();
            
        $logo_uri = 'http://dev.pedaleacao.com.br/image/logo1.png';
        $expiration_date = new DateTime();
        $expiration_date->add(new DateInterval('P3D'));                
        $instruction_lines = [
            "Atenção,",                                         //First
            "fique atento à data de vencimento do boleto.",     //Second
            "Pague em qualquer agencia bancária ou lotérica."   //Third
        ];
        $payment = $order->payments()
            ->setBoleto($expiration_date, $logo_uri, $instruction_lines)
            ->setStatementDescriptor("Pedal e Ação")
            ->execute();
        
        $output['sender']['name'] = $inscricao['nome'];
        $output['shipping']['address']['street'] = $inscricao['logradouro'];
        $output['shipping']['address']['district'] = $inscricao['bairro'];
        $output['shipping']['address']['city'] = $inscricao['cidade'];
        $output['shipping']['address']['country'] = $inscricao['UF'];
        $output['shipping']['address']['postalCode'] = $inscricao['cep'];
        $output['paymentLink'] = $payment->getHrefPrintBoleto();
        
        $json = json_encode(array('success' => true, 'response' => $output));
        
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write($json);
    } catch (Exception $ex) {        
        echo $e->getMessage();
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write(json_encode($ex));
    }
});

$app->get('/moip/notificacao', function (Request $request, Response $response, $args) use($moip) {
    try {
        // Pega o RAW data da requisição
        $json = file_get_contents('php://input');
        // Converte os dados recebidos
        $response = json_decode($json, true);

        if ($response.event == "ORDER.PAID") {
            $base = new EventoDAO($this->db);
            $base->InscricaoPaga($response->items[0]->detail);
        }
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write('"status":"ok"');
    } catch (Exception $ex) {        
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write(json_encode($ex));
    }
});

$app->get('/moip/updatePagamentos', function (Request $request, Response $response, $args) use($moip) {
    try {   
        // Without filters
        $orders = $moip->orders()->getList();
        // With filters
        $filters = new Filters();
        $filters->greaterThanOrEqual(OrdersList::CREATED_AT, "2018-04-01");
        $filters->in(OrdersList::PAYMENT_METHOD, ['BOLETO']);
        $filters->in(OrdersList::STATUS, ['PAID']);
        $orders = $moip->orders()->getList(null, $filters);
        $count = 0;
        foreach($orders->getOrders() as $ord) {
            $order = $moip->orders()->get($ord->id);
            //print_r($order->getItemIterator()->current()->detail);
            $base = new EventoDAO($this->db);
            $base->InscricaoPaga($order->getItemIterator()->current()->detail);
            $count++;
        }
        
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write('"total":"'.$count.'"');
    } catch (Exception $ex) {
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write(json_encode($ex));
    }
});

$app->get('/moip/updatePagamentos2', function (Request $request, Response $response, $args) use($moip) {
    try {   
        // Without filters
        $orders = $moip->orders()->getList();
        
        // With filters no_paid
        $filters_nopaid = new Filters();
        $filters_nopaid->greaterThanOrEqual(OrdersList::CREATED_AT, "2018-04-01");
        $filters_nopaid->in(OrdersList::PAYMENT_METHOD, ['BOLETO']);
        $filters_nopaid->in(OrdersList::STATUS, ['NOT_PAID']);
        $orders = $moip->orders()->getList(null, $filters_nopaid);
        $count_nopaid = 0;
        foreach($orders->getOrders() as $ord) {
            $order = $moip->orders()->get($ord->id);
            //print_r($order->getItemIterator()->current()->detail);
            $base = new EventoDAO($this->db);
            $base->InscricaoNaoPaga($order->getItemIterator()->current()->detail);
            $count_nopaid++;
        }
        
        // With filters paid
        $filters_paid = new Filters();
        $filters_paid->greaterThanOrEqual(OrdersList::CREATED_AT, "2018-04-01");
        $filters_paid->in(OrdersList::PAYMENT_METHOD, ['BOLETO']);
        $filters_paid->in(OrdersList::STATUS, ['PAID']);
        $orders = $moip->orders()->getList(null, $filters_paid);
        $count_paid = 0;
        foreach($orders->getOrders() as $ord) {
            $order = $moip->orders()->get($ord->id);
            //print_r($order->getItemIterator()->current()->detail);
            $base = new EventoDAO($this->db);
            $base->InscricaoPaga($order->getItemIterator()->current()->detail);
            $count_paid++;
        }
        
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write('{"total_paid":"'.$count_paid.'","total_nopaid":"'.$count_nopaid.'"}');
    } catch (Exception $ex) {
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write(json_encode($ex));
    }
});

