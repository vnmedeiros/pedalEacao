<?php
class RelatorioDAO extends Base
{
    public function REL1 ($idEvento, $op) {
        $sql = 'select 
                   cad.nome, cad.CPF, cad.email, cad.celular,
	               cad.logradouro, cad.bairro, cad.cep,
	               cad.cidade, cad.UF, cat.descricao categoria, cat.valor,
	               eve.nome evento, cat.id idCat, eve.descricao, eve.data_evento, eve.id ideve
                from cadastro cad inner join cadastro_evento cad_eve on cad.id = cad_eve.id_cadastro 
                    inner join categoria cat on cad_eve.id_categoria = cat.id
                    inner join evento eve on cat.id_evento = eve.id
                where eve.id = :idEvento and cad_eve.pago = :opcao 
                order by cat.descricao';
            
        //$this->db->query("SET NAMES utf8");
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["idEvento" => $idEvento, "opcao" => $op]);
        
        return $stmt->fetchAll( );
    }
}
