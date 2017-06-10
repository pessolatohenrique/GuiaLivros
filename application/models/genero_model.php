<?php
class Genero_model extends CI_Model{
	public function adicionar($genero){
		return $this->db->insert("generos",$genero);
	}
	public function listar(){
		$this->db->order_by("nome","ASC");
		return $this->db->get("generos")->result_array();
	}
	/**
		*consulta um gênero por nome
		*@param $nome: nome do gênero
		*@return $genero: dados do gênero caso exista, vazio caso não exista
	*/
	public function consultaPorNome($nome){
		$nome = ucwords($nome);
		$this->db->select("g.id AS genero_id, g.nome AS genero_nome");
		$this->db->from("generos g");
		$this->db->where("g.nome",$nome);
		$genero = $this->db->get()->result_array();
		return $genero;
	}
}