<?php
class Autor_model extends CI_Model{
	function adicionar($autor){
		$inseriu = $this->db->insert("autores",$autor);
		return $inseriu;
	}
	function listar($parametros = array("autor_nome" => "")){
		$this->db->select("a.*, COUNT(l.autor_id) AS total_livros");
		$this->db->from("autores a");
		$this->db->join("livros l","a.id = l.autor_id","left");
		if($parametros['autor_nome'] != ""){
			$this->db->like("nome",$parametros['autor_nome']);
		}
		$this->db->group_by("a.nome");
		$autores = $this->db->get()->result_array();
		return $autores;
	}
	/*realiza a consulta de um autor, retornando, também, os livros publicados por ele*/
	function consultar($autor_id){
		$this->db->select("a.id AS autor_id, a.nome AS autor_nome, a.dataNasc, a.biografia, l.id AS livro_id, l.arquivo, l.titulo AS livro_nome");
		$this->db->from("autores a");
		$this->db->join("livros l","a.id = l.autor_id","left");
		$this->db->where("a.id",$autor_id);
		$this->db->order_by("livro_nome","ASC");
		$autor = $this->db->get()->result_array();
		return $autor;
	}
	/*lista apenas os nomes dos autores cadastrados, visando otimizar pesquisas JSON*/
	function listaPorNome(){
		$this->db->select("nome");
		$this->db->from("autores");
		return $this->db->get()->result_array();
	}
	/**
		*verifica se um autor existe na base de dados a partir de deu nome
		*@param $nome: nome do autor
		*@return $autor: array caso existir, NULL caso não
	*/
	function consultaPorNome($nome){
		$nome = ucwords($nome);
		$this->db->select("a.id AS autor_id, a.nome AS autor_nome, a.dataNasc, a.biografia");
		$this->db->from("autores a");
		$this->db->where("a.nome",$nome);
		$autor = $this->db->get()->result_array();
		return $autor;
	}
}