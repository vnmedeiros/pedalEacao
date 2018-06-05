<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get('/relatorio/r1/evento/{id}', function (Request $request, Response $response, $args) {
        $pdf  = null;
        $id = $args['id'];
        $opcao = (int)$request->getParam('opcao');
        
        $base = new RelatorioDAO($this->db);
        $result = "";
        if ($opcao == 1) 
            $result = $base->REL1($id,'S');
        else 
            $result = $base->REL1($id,'N');
        $data = date('j/m/Y'); 
    
        $header = "<table class=\"tbl_header\" width=\"1000\">  
               <tr>  
                 <td align=\"left\">II Desafio Dubai</td>  
                 <td align=\"right\">Gerado em: $data</td>
               </tr>
             </table>"; 
        
        $footer = "<table class=\"tbl_footer\" width=\"1000\">  
               <tr>  
                 <td align=\"left\"><a href=''>www.pedaleacao.com.br</a></td>  
                 <td align=\"right\">Página: {PAGENO}</td>  
               </tr>  
             </table>";
        
        $retorno = "";
        $retorno .= "<h2 style=\"text-align:center\"></h2>";   
        
            
        $retorno .= "<table border='1' style='border-collapse: collapse; border: 0px solid black;' width='1000' align='center' cellpadding='5'>";               
        
        $id = -1;
        $retorno .= "Nome;
                    Categoria;
                    CPF;
                    telefone;
                    bairro;
                    cep;
                    cidade;
                    UF;
                    Pago<br>";
        foreach ($result as $reg):            
            $retorno .= ucfirst(strtolower($reg['nome'])).";";
            $retorno .= "{$reg['categoria']};";
            $retorno .= "{$reg['CPF']};";
            $retorno .= "{$reg['celular']};";              
            $retorno .= "{$reg['bairro']};";  
            $retorno .= "{$reg['cep']};";  
            $retorno .= "{$reg['cidade']};";  
            $retorno .= "{$reg['UF']};";
            
            if ($opcao == 1) 
                $retorno .= "Pago<br>";
            else
                $retorno .= "Não Pago<br>";
        endforeach;
        
        $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write($retorno);
});
