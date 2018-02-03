<?php
class CategoriaEntity implements JsonSerializable
{
	protected $id;
	protected $evento;
	protected $descricao;
		    
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
		$this->evento = $data['id_evento'];
		$this->descricao = $data['descricao'];
		
    }
    
    public function getId() {
        return $this->id;
    }
    public function getEvento() {
        return $this->evento;
    }
  	public function getDescricao() {
		return $this->descricao;
	}
	public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}
