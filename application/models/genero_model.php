<?php
class Genero_model extends CI_Model{
	public function adicionar($genero){
		return $this->db->insert("generos",$genero);
	}
	public function listar(){
		$this->db->order_by("nome","ASC");
		return $this->db->get("generos")->result_array();
	}
}