<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Moip\Moip;
use Moip\Resource\Customer;
use Moip\Auth\BasicAuth;
use Moip\Resource\Orders;

$token = 'HBGJK1UQMVLCDFBP1JK74YVXJBUJFXFW';
$key = 'TBKNXRCSVGYQWNZPYHG9LKGTHGLR4VAYAE6LUU7E';

$moip = new Moip(new BasicAuth($token, $key), Moip::ENDPOINT_SANDBOX);

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
                $inscricao['logradouro'], 123,
                $inscricao['bairro'], $inscricao['cidade'], $inscricao['UF'],
                preg_replace("/[^0-9]/", "", $inscricao['cep']), 8)
            ->create();
        
        $descricao = $inscricao['evento'].' ('.$inscricao['descricao'].')';
        $valor = $inscricao['valor'];
                
        $order = $moip->orders()->setOwnId(uniqid())
            ->addItem("$descricao - nº inscrição:$idInscricao", 1, "nº inscrição:$idInscricao", $valor * 100)
            ->setCustomer($customer)
            ->create();
            
        $logo_uri = 'http://dev.pedaleacao.com.br/image/logo1.png';
        $expiration_date = new DateTime();
        $expiration_date->add(new DateInterval('P3D'));
        //$instruction_lines = ['INSTRUÇÃO 1', 'INSTRUÇÃO 2', 'INSTRUÇÃO 3'];
        $instruction_lines = [];
        $payment = $order->payments()
            ->setBoleto($expiration_date, $logo_uri, $instruction_lines)
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
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write(json_encode($ex));
    }
});