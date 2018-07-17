<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/listaEventos', function (Request $request, Response $response) {
	$base = new EventoDAO($this->db);
    $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($base->getListaEventos()));
    return $response;
});

$app->post('/listaEventos', function (Request $request, Response $response) {
	$data = $request->getParsedBody();
	$evento_data = [];
	$evento_data['nome'] = filter_var($data['nome'], FILTER_SANITIZE_STRING);
	$evento_data['descricao'] = filter_var($data['descricao'], FILTER_SANITIZE_STRING);
	$evento_data['data_evento'] = filter_var($data['data_evento'], FILTER_SANITIZE_STRING);
	$evento_data['limite_inscricao'] = filter_var($data['limite_inscricao'], FILTER_SANITIZE_STRING);
	
	$evento = new EventoEntity($evento_data);
	$base = new EventoDAO($this->db);
	$base->salvar(evento);
	$response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode("Evento Criado"));
    return $response;
});

$app->put('/evento/{id}', function (Request $request, Response $response, $args) {
	$data = $request->getParsedBody();
	
	$evento_data = [];
	$evento_data['id'] = (int)$args['id'];
	$evento_data['nome'] = filter_var($data['nome'], FILTER_SANITIZE_STRING);
	$evento_data['descricao'] = filter_var($data['descricao'], FILTER_SANITIZE_STRING);
	$evento_data['data_evento'] = filter_var($data['data_evento'], FILTER_SANITIZE_STRING);
	$evento_data['limite_inscricao'] = filter_var($data['limite_inscricao'], FILTER_SANITIZE_STRING);
	
	$evento = new EventoEntity($evento_data);
	$base = new EventoDAO($this->db);
	$base->update(evento);
	$response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode("Evento Atualizado"));
    return $response;
});

$app->delete('/evento/{id}', function (Request $request, Response $response, $args) {
	$id = (int)$args['id'];    
	$base = new EventoDAO($this->db);
	$base->delete($id);
	$response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode("Evento Deletado"));
    return $response;
});

$app->get('/evento/categorias/{idEvento}', function (Request $request, Response $response, $args) {
	$idEvento = (int)$args['idEvento'];
    $base = new EventoDAO($this->db);    
    $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($base->getCategorias($idEvento)));
    return $response;
});

$app->get('/evento/inscritos/{idEvento}', function (Request $request, Response $response, $args) {
	$idEvento = (int)$args['idEvento'];
    $base = new EventoDAO($this->db);    
    $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($base->getInscritos($idEvento)));
    return $response;
});

function download_page($path){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$path);
    curl_setopt($ch, CURLOPT_FAILONERROR,1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $retValue = curl_exec($ch);          
    curl_close($ch);
    return $retValue;
}

$app->post('/evento/inscricao', function (Request $request, Response $response) {
    try {
        $data = $request->getParsedBody();
        $idEvento = filter_var($data['idEvento'], FILTER_SANITIZE_STRING);
        $idCadastro = filter_var($data['idCadastro'], FILTER_SANITIZE_STRING);
        $idCategoria = filter_var($data['selectCategoria'], FILTER_SANITIZE_STRING);
        $base = new EventoDAO($this->db);
                
        $ins = ['success' => true, 
                'inscricao' => ['id' => $base->inscrever($idCadastro, $idCategoria),
                                'idCadastro' => $idCadastro,
                                'idCategoria' => $idCategoria,
                                'success' => true]];
        
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($ins));        
    } catch (Exception $ex) {
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write(json_encode($ex));        
    }
});

$app->get('/evento/InscritosDupla/{idEvento}', function (Request $request, Response $response, $args) {
    $idEvento = (int)$args['idEvento'];
    $base = new EventoDAO($this->db);
    $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($base->getInscritosDupla($idEvento)));
    return $response;
});

$app->get('/evento/duplas/{idEvento}', function (Request $request, Response $response, $args) {
    $idEvento = (int)$args['idEvento'];
    $base = new EventoDAO($this->db);
    $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($base->getDupla($idEvento)));
    return $response;    
});

$app->post('/evento/duplas', function (Request $request, Response $response) {
    try {
        $data = $request->getParsedBody();
        $participante1 = filter_var($data['participante1'], FILTER_SANITIZE_STRING);
        $participante2 = filter_var($data['participante2'], FILTER_SANITIZE_STRING);
        //$participante1 = (int)$args['participante1'];
        //$participante2 = (int)$args['participante2'];
        $base = new EventoDAO($this->db);
        $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($base->registrarDupla($participante1, $participante2)));
        return $response;
    } catch (Exception $ex) {
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write(json_encode($ex));        
    }
});
