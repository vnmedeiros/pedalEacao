<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post('/cadastro', function (Request $request, Response $response) {
	try {
		$data = $request->getParsedBody();
		$cadastro_data = [];
		$cadastro_data['CPF'] = filter_var($data['cpf'], FILTER_SANITIZE_STRING);
		$cadastro_data['nascimento'] = filter_var($data['nascimento'], FILTER_SANITIZE_STRING);
        $cadastro_data['nome'] = filter_var($data['nome'], FILTER_SANITIZE_STRING);
		$cadastro_data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
		$cadastro_data['celular'] = filter_var($data['celular'], FILTER_SANITIZE_STRING);
		$cadastro_data['logradouro'] = filter_var($data['logradouro'], FILTER_SANITIZE_STRING);
		$cadastro_data['bairro'] = filter_var($data['bairro'], FILTER_SANITIZE_STRING);
		$cadastro_data['cep'] = filter_var($data['cep'], FILTER_SANITIZE_STRING);
		$cadastro_data['cidade'] = filter_var($data['cidade'], FILTER_SANITIZE_STRING);
		$cadastro_data['UF'] = filter_var($data['UF'], FILTER_SANITIZE_STRING);
		
		$cadastro_data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);

		$cadastro = new CadastroEntity($cadastro_data);
		$base = new CadastroDAO($this->db);
		
		if ($cadastro_data['id']) {
			$base->update($cadastro);
		} else {
			$cadastro->setId($base->salvar($cadastro));
		}		
		
		return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
			->write(json_encode(array('success' => true, 'cadastro' => $cadastro)));
	} catch (Exception $e) {        
		return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
			->write(json_encode(array('success' => false, 'msg' => $e)));		
	}    
});

$app->get('/cadastros/cpf/{cpf}', function (Request $request, Response $response, $args) {
    try {
        $cpf = $args['cpf'];
	$base = new CadastroDAO($this->db);
        $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($base->getCadastroCPF($cpf)));        
    } catch (Exception $ex) {
        $cadastro = new CadastroEntity(["CPF" => $cpf]);
        $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($cadastro));
    }
    return $response;
});
