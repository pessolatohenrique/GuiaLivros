<?php
class Genero_model extends CI_Model{
	public function adicionar($genero){
		return $this->db->insert("generos",$genero);
	}
	public function listar($aleatorio = 0){
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
	/**
		*lista os gêneros relacionados com livros e usuários
	*/
	public function listaRelLivro($usuario_id,$random=0){
		$this->db->select("gen.id,gen.nome AS genero_nome");
		$this->db->distinct();
		$this->db->from("usuariolivro main");
		$this->db->join("livros li","main.livro_id = li.id");
		$this->db->join("generos gen","li.genero_id = gen.id");
		$this->db->where("main.usuario_id",$usuario_id);
		$this->db->where("main.status_id",1);
		if($random == 1){
			$this->db->order_by("rand()");
		}
		return $this->db->get()->result_array();

	}
}