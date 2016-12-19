<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_cria_tabela_livro extends CI_Migration{
	public function up(){
		/*autor_id, genero_id, editora_id, arquivo, titulo, ano, paginas, sinopse*/
		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT','auto_increment' => TRUE),
			'autor_id' => array('type' => 'INT'),
			'genero_id' => array('type' => 'INT'),
			'editora_id' => array('type' => 'INT'),
			'arquivo' => array('type'=> 'VARCHAR','constraint' => '255'),
			'titulo' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => FALSE),
			'ano' => array('type' => 'CHAR','constraint' => '4'),
			'paginas' => array('type' => 'VARCHAR', 'constraint' => '4'),
			'sinopse' => array('type' => 'TEXT')
		));
		$this->dbforge->add_key("id",TRUE);
		$this->dbforge->create_table("livros");
		$this->db->query("ALTER TABLE livros ADD FOREIGN KEY (autor_id) REFERENCES autores(id);");
		$this->db->query("ALTER TABLE livros ADD FOREIGN KEY (genero_id) REFERENCES generos(id);");
		$this->db->query("ALTER TABLE livros ADD FOREIGN KEY (editora_id) REFERENCES editoras(id);");
	}
	public function down(){
		$this->dbforge->drop_table("livros");
	}
}