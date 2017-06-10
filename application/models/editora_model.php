<?php
class Editora_model extends CI_Model{
	public function adicionar($editora){
		return $this->db->insert("editoras",$editora);
	}
	public function listar(){
		$this->db->order_by("nome","ASC");
		return $this->db->get("editoras")->result_array();
	}
	/**
		*consulta uma editora por nome
		*@param $nome: nome da editora
		*@return $editora: dados da editora caso exista, vazio caso não exista
	*/
	public function consultaPorNome($nome){
		$nome = ucwords($nome);
		$this->db->select("e.id AS editora_id, e.nome AS editora_nome");
		$this->db->from("editoras e");
		$this->db->where("e.nome",$nome);
		$editora = $this->db->get()->result_array();
		return $editora;
	}
}