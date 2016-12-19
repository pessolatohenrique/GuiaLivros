<?php
class Usuario_livro_model extends CI_Model{
	public function adiciona($livro){
		return $this->db->insert("usuariolivro",$livro);
	}
	public function consulta($usuario_id,$livro_id){
		$this->db->select("p.*,l.titulo,s.descricao");
		$this->db->from("usuariolivro p");
		$this->db->join("livros l","p.livro_id = l.id");
		$this->db->join("status_leitura s","p.status_id = s.id");
		$this->db->where("usuario_id",$usuario_id);
		$this->db->where("livro_id",$livro_id);
		return $this->db->get()->row_array();
	}
	public function exclui($usuario_id,$livro_id){
		$this->db->where("usuario_id",$usuario_id);
		$this->db->where("livro_id",$livro_id);
		$this->db->delete("usuariolivro");
	}
	public function consultaStatus($usuario_id,$livro_id){
		$this->db->select("p.*,s.descricao AS status_descricao");
		$this->db->from("usuariolivro p");
		$this->db->join("status_leitura s","p.status_id = s.id");
		$this->db->where("usuario_id",$usuario_id);
		$this->db->where("livro_id",$livro_id);
		return $this->db->get()->row_array();
	}
	/*lista os livros de um determinado usuário, de acordo com um status*/
	public function listar($parametros,$quantidade=0,$inicio=0){
		if($parametros['status_leitura'] == ""){
			$parametros['status_leitura'] = 1;
		}
		$this->db->select("p.usuario_id, p.livro_id, p.status_id, p.data,s.descricao,a.id AS autor_id, a.nome AS autor_nome,
		g.id AS genero_id, g.nome AS genero_nome,
		e.id AS editora_id, e.nome AS editora_nome, main.id AS main_id, main.titulo, main.ano, main.paginas, main.sinopse,main.arquivo");
		$this->db->from("usuariolivro p ");
		$this->db->join("livros main","p.livro_id = main.id");
		$this->db->join("status_leitura s","p.status_id = s.id");
		$this->db->join("autores a","main.autor_id = a.id");
		$this->db->join("generos g","main.genero_id = g.id");
		$this->db->join("editoras e","main.editora_id = e.id");
		$this->db->where("p.usuario_id",$parametros['usuario_id']);
		$this->db->where("p.status_id",$parametros['status_leitura']);
		$this->db->order_by($parametros['ordenacao']['campo'],$parametros['ordenacao']['criterio']);
		$this->db->limit($quantidade,$inicio);
		return $this->db->get()->result_array();
	}
	public function numero_registros($parametros){
		$livros = $this->listar($parametros);
		return count($livros);
	}
	public function consultaTotalPorStatus($usuario_id){
		$this->db->select("p.status_id, COUNT(p.livro_id) AS total_status");
		$this->db->from("usuariolivro p");
		$this->db->where("p.usuario_id",$usuario_id);
		$this->db->group_by("p.status_id");
		return $this->db->get()->result_array();
	}
	/*cria estatísticas por autor, gênero ou editora para livros com status JÁ LI, com objetivo de gerar gráficos
	usuario_id => id do usuário logado via sessão;
	tipo_pesquisa => input post da pesquisa. Pode ter os valores: autor, gênero ou editora*/
	public function criaEstatistica($usuario_id,$tipo_pesquisa,$data){
		if($tipo_pesquisa != "status"){
			$campo = "nome";
		}else{
			$campo = "descricao";
		}
		$this->db->select("{$tipo_pesquisa}.{$campo} AS pesquisa_nome, COUNT({$tipo_pesquisa}.{$campo}) AS total_pesquisa, SUM(main.paginas) AS paginas_pesquisa");
		$this->db->from("usuariolivro p");
		$this->db->join("livros main","p.livro_id = main.id");
		$this->db->join("status_leitura status","p.status_id = status.id");
		$this->db->join("autores autor","main.autor_id = autor.id");
		$this->db->join("generos genero","main.genero_id = genero.id");
		$this->db->join("editoras editora","main.editora_id = editora.id");
		$this->db->where("p.usuario_id",$usuario_id);
		$this->db->where("p.status_id",1);
		if($tipo_pesquisa == "status"){
			$this->db->or_where("p.status_id",4);
		}
		if($data['inicio'] != "" && $data['fim'] != ""){
			/*AND p.data >= '2016-01-01'
			AND p.data <= '2016-12-31'*/
			$this->db->where("data >=",$data['inicio']);
			$this->db->where("data <=",$data['fim']);
		}
		$this->db->group_by($tipo_pesquisa.".{$campo}");
		return $this->db->get()->result_array();
	}
	public function estatisticaPaginaAno($usuario_id,$filtro){
		$query = $this->db->query(
			"SELECT p.livro_id, livro.titulo, livro.ano, livro.paginas FROM `usuariolivro` p 
			INNER JOIN livros livro ON p.livro_id = livro.id 
			WHERE usuario_id = {$usuario_id} AND p.status_id = 1 
			AND 
			(livro.{$filtro} = (SELECT MAX(livro.{$filtro}) FROM usuariolivro p 
			INNER JOIN livros livro ON p.livro_id = livro.id WHERE p.usuario_id = {$usuario_id} AND p.status_id = 1)
			OR livro.{$filtro} = (SELECT MIN(livro.{$filtro}) FROM usuariolivro p 
			INNER JOIN livros livro ON p.livro_id = livro.id WHERE p.usuario_id = {$usuario_id} AND p.status_id = 1))
			ORDER BY livro.{$filtro} DESC");
		$vetor['primeiro'] = $query->first_row("array");
		$vetor['ultimo'] = $query->last_row("array");
		// return $query->result_array();
		return $vetor;
	}
}