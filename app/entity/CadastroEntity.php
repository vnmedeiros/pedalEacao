<?php
class CadastroEntity implements JsonSerializable
{
	protected $id;
	protected $nome;
  	protected $CPF;
	protected $email;
	protected $celular;
	protected $nascimento;
	protected $logradouro;
	protected $bairro;
	protected $cep;
	protected $cidade;
  	protected $UF;
	    
    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['id']) && $data['id']) {
            $this->id = $data['id'];
        }        
		$this->CPF = $data['CPF'];
		$this->nascimento = date("d/m/Y", strtotime($data['nascimento']));        
		$this->nome = $data['nome'];
		$this->email = $data['email'];
		$this->celular = $data['celular'];
		$this->logradouro = $data['logradouro'];
		$this->bairro = $data['bairro'];
		$this->cep = $data['cep'];
		$this->cidade = $data['cidade'];
		$this->UF = $data['UF'];		
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

  	public function getCPF() {
		return $this->CPF;
	}

	public function getEmail() {
		return $this->email;
	}	
	
	public function getCelular() {
		return $this->celular;
	}
	
	public function getNascimento() {
		return $this->nascimento;
	}

	public function getLogradouro() {
			return $this->logradouro;
	}

	public function getBairro() {
		return $this->bairro;
	}

	public function getCep() {
		return $this->cep;
	}

	public function getCidade() {
		return $this->cidade;
	}

  	public function getUF() {
		return $this->UF;
	}

	public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}
