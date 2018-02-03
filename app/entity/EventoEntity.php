<?php
class EventoEntity implements JsonSerializable
{
	protected $id;
	protected $nome;
	protected $descricao;
	protected $data_evento;
	protected $limite_inscricao;
	    
    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['id'])) {
            $this->id = $data['id'];
        }

		$this->nome = $data['nome'];
		$this->descricao = $data['descricao'];
		$this->data_evento = $data['data_evento'];
		$this->limite_inscricao = $data['limite_inscricao'];
    }    
    public function getId() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getDescricao() {
        return $this->descricao;
    }
    public function getDataEvento() {
        return $this->data_evento;
    }
    public function getLimiteInscricao() {
		return $this->limite_inscricao;
	}
	public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}
