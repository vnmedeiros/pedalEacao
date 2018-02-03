<?php
class CadastroDAO extends Base
{
    public function salvar(CadastroEntity $cadastro) {
		$sql = "INSERT INTO cadastro(nome, CPF, email, celular, nascimento, 
							logradouro, bairro, cep, cidade, UF) 
							VALUES (:nome, :cpf, :email, :celular, :nascimento, :logradouro, :bairro, :cep, :cidade, :UF)";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
			"nome" => $cadastro->getNome(),
			"cpf" => $cadastro->getCPF(),
			"email" => $cadastro->getEmail(),
			"celular" => $cadastro->getCelular(),
			"nascimento" => date("Y-m-d", strtotime($cadastro->getNascimento())),
			"logradouro" => $cadastro->getLogradouro(),
			"bairro" => $cadastro->getBairro(),
			"cep" => $cadastro->getCep(),
			"cidade" => $cadastro->getCidade(),
			"UF" => $cadastro->getUF()
        ]);
        
        if(!$result) {
            throw new Exception("could not save record");
        }
        return $this->db->lastInsertId('cadastro_id_seq');
    }
    
    public function update(CadastroEntity $cadastro) {
		$sql = "UPDATE cadastro SET nome=:nome, CPF=:CPF, email=:email, 
						celular=:celular, nascimento=:nascimento, 
						logradouro=:logradouro, bairro=:bairro, 
						cep=:cep, cidade=:cidade, UF=:UF
				WHERE id=:id";
        
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
			"nome" => $cadastro->getNome(),
			"CPF" => $cadastro->getCPF(),
			"email" => $cadastro->getEmail(),
			"celular" => $cadastro->getCelular(),
			"nascimento" => date("Y-m-d", strtotime($cadastro->getNascimento())),
			"logradouro" => $cadastro->getLogradouro(),
			"bairro" => $cadastro->getBairro(),
			"cep" => $cadastro->getCep(),
			"cidade" => $cadastro->getCidade(),
			"UF" => $cadastro->getUF(),
			"id" => $cadastro->getId()
        ]);
        
        if(!$result) {
            throw new Exception("could not update record");
        }
    }
    
    public function delete($id) {
		$sql = "DELETE FROM cadastro WHERE id=:id";
		$stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["id" => $evento->getId()]);
        if(!$result) {
            throw new Exception("could not delete record");
        }
	}

	public function getCadastroCPF($cpf) {
        $results = -1;
		$sql = 'SELECT id, nome, CPF, email, celular, nascimento, logradouro, 
			bairro, cep, cidade, UF FROM cadastro where CPF = :cpf';
		$stmt = $this->db->prepare($sql);
        $stmt->execute(["cpf" => (string)$cpf]);
        $results = $stmt->fetch();        
        if($results == false) {            
            throw new Exception("Empty set");
        }        
        $cadastro = new CadastroEntity($results);
        return $cadastro;
	}
}
