<?php
class Editora_model extends CI_Model{
	public function adicionar($editora){
		return $this->db->insert("editoras",$editora);
	}
	public function listar(){
		$this->db->order_by("nome","ASC");
		return $this->db->get("editoras")->result_array();
	}
}