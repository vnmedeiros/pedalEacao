<?php
class EventoDAO extends Base
{
    public function getListaEventos() {
        $sql = "SELECT id, nome, descricao, data_evento, limite_inscricao FROM evento;";
        $stmt = $this->db->query($sql);
        $results = [];        
        while($row = $stmt->fetch()) {
			$evento = new EventoEntity($row);			
            $results[] = $evento;
        }
        return $results;
    }
    
    public function getEvento($idEvento) {
        $sql = "SELECT id, nome, descricao, data_evento, limite_inscricao FROM evento WHERE id = :id;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $idEvento]);        
        $evento = new EventoEntity($stmt->fetch());        
        return $evento;
    }
    
    public function salvar(EventoEntity $evento) {
		$sql = " INSERT INTO evento (nome, descricao, data_evento, limite_inscricao)
				VALUES (:nome, :descricao, :data_evento, :limite_inscricao)";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "nome" => $evento->getNome(),
            "descricao" => $evento->getDescricao(),
            "data_evento" => $evento->getDataEvento(),
            "limite_inscricao" => $evento->getLimiteInscricao()
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }
    
    public function update(EventoEntity $evento) {
		$sql = " UPDATE evento SET nome=:nome, 
								   descricao=:descricao, 
								   data_evento=:data_evento, 
								   limite_inscricao=:limite_inscricao
				WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
			"id" => $evento->getId(),
            "nome" => $evento->getNome(),
            "descricao" => $evento->getDescricao(),
            "data_evento" => $evento->getDataEvento(),
            "limite_inscricao" => $evento->getLimiteInscricao()
        ]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }
    
    public function delete($id) {
		$sql = "DELETE FROM evento WHERE id=:id";
		$stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $evento->getId()]);
        if(!$result) {
            throw new Exception("could not update record");
        }
	}
	
	public function getCategorias($idEvento) {
		$sql = "SELECT id, id_evento, descricao FROM categoria Where id_evento=:id_evento ORDER BY descricao";
		$stmt = $this->db->prepare($sql);
        $stmt->execute(["id_evento" => $idEvento]);
        while($row = $stmt->fetch()) {			
			$categoria = new CategoriaEntity($row);
            $results[] = $categoria;
        }
        return $results;
	}

    public function inscrever($idCadastro, $idCategoria) {
        //$sql = "INSERT INTO cadastro_evento(id_cadastro, id_categoria)
		//		VALUES (:idCadastro, :idCategoria)";
        
        $sql = "INSERT INTO cadastro_evento(id_cadastro, id_categoria) 
                VALUES (:idCadastro, :idCategoria) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id), id_cadastro=:idCadastro, id_categoria=:idCategoria";
        
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "idCadastro" => $idCadastro,
            "idCategoria" => $idCategoria
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
        return $this->db->lastInsertId('cadastro_evento_id_seq');
    }
    
    public function getResume($idInscricao) {
        $sql = 'select 
	               cad.nome, cad.CPF,cad.email,cad.celular,
	               cad.logradouro,cad.bairro,cad.cep,
	               cad.cidade,cad.UF,cat.descricao,cat.valor,
	               eve.nome evento,eve.descricao,eve.data_evento, eve.id ideve
                from cadastro cad inner join cadastro_evento cad_eve on cad.id = cad_eve.id_cadastro 
                    inner join categoria cat on cad_eve.id_categoria = cat.id
                    inner join evento eve on cat.id_evento = eve.id
                where cad_eve.id = :idInscricao';
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["idInscricao" => $idInscricao]);
        return $stmt->fetch();
    }
    
    public function InscricaoPaga($idInscricao) {
        $sql = 'update cadastro_evento set pago = "S" where id = :idInscricao';
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["idInscricao" => $idInscricao]);
        if(!$result) {
            throw new Exception("could not update record");
        }
    }
}
