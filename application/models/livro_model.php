<?php
class Livro_model extends CI_Model{
	public function adicionar($livro){
		return $this->db->insert("livros",$livro);
	}
	public function listar($parametros,$quantidade=0,$inicio=0){
		$this->db->select("a.id AS autor_id, a.nome AS autor_nome,a.dataNasc AS autor_data,a.biografia as autor_biografia, 
			g.id AS genero_id, g.nome AS genero_nome,
			e.id AS editora_id, e.nome AS editora_nome, main.id AS livro_id, main.titulo, main.ano, main.paginas, main.sinopse,main.arquivo");
		$this->db->from("livros main");
		$this->db->join("autores a", "main.autor_id = a.id");
		$this->db->join("generos g", "main.genero_id = g.id");
		$this->db->join("editoras e", "main.editora_id = e.id");
		//filtragem dinâmica através do where
		if($parametros['autor_id'] != ""){
			$this->db->where("autor_id",$parametros['autor_id']);
		}
		if($parametros['genero_id'] != ""){
			$this->db->where("genero_id",$parametros["genero_id"]);
		}
		if($parametros['editora_id'] != ""){
			$this->db->where("editora_id",$parametros["editora_id"]);
		}
		if($parametros['titulo'] != ""){
			$this->db->like("titulo",$parametros['titulo']);
		}
		if($parametros['lancamento'] != ""){
			$this->db->where("ano",$parametros['lancamento']);
		}
		if($parametros['paginas'] != ""){
			$this->db->where("paginas >=",$parametros['paginas']);
		}
		$this->db->order_by($parametros['ordenacao']['campo'],$parametros['ordenacao']['criterio']);
		$this->db->limit($quantidade,$inicio);
		return $this->db->get()->result_array();
	}
	public function consultar($livro_id){
		$this->db->select("a.id AS autor_id, a.nome AS autor_nome,a.dataNasc AS autor_data,a.biografia as autor_biografia, 
			g.id AS genero_id, g.nome AS genero_nome,
			e.id AS editora_id, e.nome AS editora_nome, main.id AS livro_id, main.titulo, main.ano, main.paginas, main.sinopse,main.arquivo");
		$this->db->from("livros main");
		$this->db->join("autores a", "main.autor_id = a.id");
		$this->db->join("generos g", "main.genero_id = g.id");
		$this->db->join("editoras e", "main.editora_id = e.id");
		$this->db->where("main.id",$livro_id);
		return $this->db->get()->row_array();
	}
	public function numero_registros(){
		$parametros = array(
			'autor_id' => $this->input->get("autor"), 
			'genero_id' => $this->input->get("genero"),
			'editora_id' => $this->input->get("editora"),
			'titulo' => $this->input->get("titulo"),
			'lancamento' => $this->input->get("ano"),
			'paginas' => $this->input->get("paginas"),
			'ordenacao' => verifica_ordenacao($this->input->get("ordenacao"))
		);
		return count($this->listar($parametros));
		// return $query->num_rows();
	}
	/*retorna apenas os nomes dos livros, de modo a otimizar buscas JSON*/
	public function listaPorNome(){
		$this->db->select("titulo");
		$this->db->from("livros");
		$this->db->order_by("titulo","ASC");
		return $this->db->get()->result_array();
	}
}