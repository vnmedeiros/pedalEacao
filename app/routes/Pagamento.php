<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//$config = ['email' => 'vnicius.nm.ba@gmail.com',
//           'token' => 'D12E4B512B5F478FBD54CFD3AEC9145C',           
//           'urlBasica' => 'https://ws.sandbox.pagseguro.uol.com.br'];
           
$config = ['email' => 'desafio.xcm@gmail.com',
           'token' => '25042BD1405D4781AA4FDFE5874E6B83',           
           'urlBasica' => 'https://ws.pagseguro.uol.com.br'];

$app->get('/getSessionPagSeguro', function (Request $request, Response $response) use($config) {
    $url = $config['urlBasica'].'/v2/sessions/?email='.$config['email'].'&token='.$config['token'];
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $dadosCompra);
    $respostaPagSeguro = curl_exec($curl);
    $response->withStatus(200)->withHeader('Content-Type', 'application/xml')->write($respostaPagSeguro);
});

$app->post('/finalizarInscricao', function (Request $request, Response $response) use($config) {
    try {
        $data = $request->getParsedBody();
        $idInscricao = filter_var($data['idInscricao'], FILTER_SANITIZE_STRING);
        $senderHash = filter_var($data['SenderHash'], FILTER_SANITIZE_STRING);
        
        $base = new EventoDAO($this->db);
        $inscricao = $base->getResume($idInscricao);        
        
        $email =  $config['email'];
        $token =  $config['token'];
        
        $URL = $config['urlBasica'].'/v2/transactions';
        
        $POSTFIELDS = "email=$email&token=$token&senderHash=$senderHash";
        $POSTFIELDS .= "&paymentMode=default";
        $POSTFIELDS .= "&paymentMethod=boleto";
        $POSTFIELDS .= "&receiverEmail=$email";
        $POSTFIELDS .= "&currency=BRL";
        $POSTFIELDS .= "&extraAmount=0.00";
        $POSTFIELDS .= "&itemId1=$idInscricao";
        $POSTFIELDS .= "&itemDescription1=".$inscricao['evento'].' ('.$inscricao['descricao'].')';        
        $POSTFIELDS .= "&itemAmount1=".number_format((float)$inscricao['valor'], 2,'.','');
        $POSTFIELDS .= "&itemQuantity1=1";
        $POSTFIELDS .= "&notificationURL=http://www.pedaleacao.com.br/public/API/notificacaoPagamento";
        $POSTFIELDS .= "&reference=".$inscricao['ideve'];
        $POSTFIELDS .= "&senderName=".$inscricao['nome'];
        $POSTFIELDS .= "&senderCPF=".preg_replace("/[^0-9]/", "", $inscricao['CPF']);
        $POSTFIELDS .= "&senderAreaCode=".substr(preg_replace("/[^0-9]/", "", $inscricao['celular']), 0, 2);
        $POSTFIELDS .= "&senderPhone=".substr(preg_replace("/[^0-9]/", "", $inscricao['celular']), 2, 11);
        $POSTFIELDS .= "&senderEmail=".$inscricao['email'];
        $POSTFIELDS .= "&shippingAddressStreet=".$inscricao['logradouro'];
        $POSTFIELDS .= "&shippingAddressNumber=x";
        $POSTFIELDS .= "&shippingAddressComplement=x";
        $POSTFIELDS .= "&shippingAddressDistrict=".$inscricao['bairro'];
        $POSTFIELDS .= "&shippingAddressPostalCode=".preg_replace("/[^0-9]/", "", $inscricao['cep']);
        $POSTFIELDS .= "&shippingAddressCity=".$inscricao['cidade'];
        $POSTFIELDS .= "&shippingAddressState=".$inscricao['UF'];
        $POSTFIELDS .= "&shippingAddressCountry=ATA";
        $POSTFIELDS .= "&shippingType=1";
        $POSTFIELDS .= "&shippingCost=0.00";
        
        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-Type: application/x-www-form-urlencoded; charset=UTF-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
                        
        $output = curl_exec($ch);
        //$A = $output;
        curl_close($ch);        
        $output = simplexml_load_string($output);
        $json = json_encode(array('success' => true, 'response' => $output, 'DEBUG'=>$A));        
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write($json);
    } catch (Exception $ex) {
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write(json_encode($ex));  
    }
});


$app->post('/notificacaoPagamento', function (Request $request, Response $response, $args) use($config) {
    $data = $request->getParsedBody();    
    $notificationCode = filter_var($data['notificationCode'], FILTER_SANITIZE_STRING);
    $notificationType = filter_var($data['notificationType'], FILTER_SANITIZE_STRING);    
    
    //$notificationCode = (int)$args['notificationCode']; 
    //$notificationType = $args['notificationType'];
    
    if ($notificationType == "transaction") {
        $url = $config['urlBasica'].'/v3/transactions/notifications/'.$notificationCode.'?email='.$config['email'].'&token='.$config['token'];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($curl);
        $http = curl_getinfo($curl);
        curl_close($curl);
        if($response == 'Unauthorized') {
            return $response->withStatus(301)->withHeader('Content-Type', 'application/xml')->write($response);    
            exit;
        }        
        $response= simplexml_load_string($response); 
        if(count($response->error) > 0) {
            return $response->withStatus(500)->withHeader('Content-Type', 'application/xml')->write($response);    
            exit;
        }
        
        if ($transaction->status == 3 || $transaction->status == 4) {
            $base = new EventoDAO($this->db);
            $base->InscricaoPaga($response->items->item[0]->id);
        }
    }
});


$app->get('/transactions/{initialDate}/{finalDate}', function (Request $request, Response $response, $args) use($config) {
    $initialDate =  $args['initialDate'] . 'T00:00';
    $finalDate = $args['finalDate'] . 'T00:00';    
    $url = $config['urlBasica'].'/v2/transactions/?initialDate='.$initialDate.'&finalDate='.$finalDate.'&page=1&maxPageResults=1000'.'&email='.$config['email'].'&token='.$config['token'];
    
//    echo $url . '<br><br>';
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $http = curl_getinfo($curl);
    curl_close($curl);
    $response= simplexml_load_string($response);    
    
    if(count($response->error) > 0) {
        return $response->withStatus(500)->withHeader('Content-Type', 'application/xml')->write($response);
        exit;
    }
    
    /*$xml = <<<BUFFER
<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?><transaction><date>2018-01-19T14:21:32.000-02:00</date><code>C65B6139-6A21-4E16-A672-7EC9B1904E38</code><reference>1</reference><type>1</type><status>3</status><lastEventDate>2018-01-20T03:34:14.000-02:00</lastEventDate><paymentMethod><type>2</type><code>202</code></paymentMethod><paymentLink>https://pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=fab5be5a7fc23392d540761e9cb625437db28243fe9ced495f15b5469506a34681ddf5e520f724d1</paymentLink><grossAmount>79.00</grossAmount><discountAmount>0.00</discountAmount><feeAmount>3.55</feeAmount><netAmount>75.45</netAmount><extraAmount>0.00</extraAmount><escrowEndDate>2018-02-19T02:34:15.000-03:00</escrowEndDate><installmentCount>1</installmentCount><itemCount>1</itemCount><items><item><id>114</id><description>1 Desafio XCM MTB 1 desafio de ciclismo de XCM MTB.</description><quantity>1</quantity><amount>79.00</amount></item></items><sender><name>Leonardo Murilo Sehn</name><email>elizetesehn@hotmail.com</email><phone><areaCode>63</areaCode><number>992217357</number></phone></sender><shipping><address><street>R. Topázio </street><number>x</number><complement>x</complement><district>Cavalcante </district><city>Dianopolis </city><state>TO</state><country>BRA</country><postalCode>77300000</postalCode></address><type>1</type><cost>0.00</cost></shipping></transaction>
BUFFER;
    $response= simplexml_load_string($xml);
    echo $response->items->item[0]->id*/
    
    ?>
        <table>
            <tr><td>status</td><td>code</td><td>id</td><td>nome</td></tr>
    <?php
    
    foreach ($response->transactions->transaction as $transaction) {
        if ($transaction->status == 3 || $transaction->status == 4) {
            echo "<tr><td>$transaction->status</td><td>$transaction->code</td>";
            $url = $config['urlBasica'].'/v2/transactions/'.$transaction->code.'?email='.$config['email'].'&token='.$config['token'];            
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $item = curl_exec($curl);
            $http = curl_getinfo($curl);
            curl_close($curl);
            $item = simplexml_load_string($item);
            echo "<td>" . $item->items->item[0]->id . "</td>";
            echo "<td>". $item->sender->name . "</td></tr>";
            //if( atualizarBD == 1 ) {
                $base = new EventoDAO($this->db);
                $base->InscricaoPaga($item->items->item[0]->id);
            //}
        }
    }
    ?>
        </table>
    <?php
});
