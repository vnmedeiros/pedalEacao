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
        
            
        //$retorno .= "<table border='1' style='border-collapse: collapse; border: 0px solid black;' width='1000' align='center' cellpadding='5'>";               
        
        $id = -1;
        $catAux = "";
        $first = true;
        //$retorno .= "<tr>
        //            <th>Nome</th>
        //            <th>Categoria</th>
        //            <th>CPF</th>
        //            <th>telefone</th>
        //            <th>bairro</th>
        //            <th>cep</th>
        //            <th>cidade</th>
        //            <th>UF</th>
        //            <th>Status</th></tr>";
        $retorno = "";
        foreach ($result as $reg):
            if($catAux != $reg['categoria']) {
                $catAux = $reg['categoria'];
                if(!$first) {
                    $retorno .=  "</table>";
                }
                $retorno .= "<br /><b>Categoria:{$catAux}</b><br /><br /><table border='1' style='border-collapse: collapse; border: 0px solid black;' width='1000' align='center' cellpadding='5'>";
                $retorno .= "<tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>CPF</th>
                    <th>telefone</th>
                    <th>bairro</th>
                    <th>cep</th>
                    <th>cidade</th>
                    <th>UF</th>
                    <th>Status</th></tr>";
                $first = false;
                
            }
            $retorno .= "<tr><td>". ucfirst(strtolower($reg['nome']))."</td>";
            $retorno .= "<td>{$reg['categoria']}</td>";
            $retorno .= "<td>" . substr($reg['CPF'],0,3) . "...</td>";
            $retorno .= "<td>{$reg['celular']}</td>";
            $retorno .= "<td>{$reg['bairro']}</td>";
            $retorno .= "<td>{$reg['cep']}</td>";
            $retorno .= "<td>{$reg['cidade']}</td>";
            $retorno .= "<td>{$reg['UF']}</td>";
            
            if ($opcao == 1) 
                $retorno .= "<td>Pago</td></tr>";
            else
                $retorno .= "<td>Não Pago</td></tr>";
        endforeach;
        $retorno .= "</table>";
        
        $css = "
                @media print {
                    
                    @page {
                        size:  auto;
                        margin: 0mm;
                    }
                    
                    body {
                        font-size: 1em;
                        margin-top: 2cm;
                        margin-right: 2cm;
                        margin-bottom: 1.5cm;
                        margin-left: 2cm
                    }
                    
                    table {
                        margin-top: 0.5cm;
                        page-break-after: always;
                        display: block;
                    }
                    
                    button {
                        display: none;
                    }
                }
                
                table {
                    margin-bottom: 2cm;
                }
                ";
        
        $body = "<html><style>{$css}</style><body><button onclick='window.print();'>Imprimir</button>{$retorno}</body></html>";
        $response->withStatus(200)->withHeader('Content-Type', 'text/html')->write($body);
});
