<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_cria_tabela_usuariolivro extends CI_Migration{
	public function up(){
		/*id,usuario_id,livro_id,status_id,data*/
		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT','auto_increment' => TRUE),
			'usuario_id' => array('type' => 'INT'),
			'livro_id' => array('type' => 'INT'),
			'status_id' => array('type' => 'INT'),
			'data' => array('type'=> 'DATE')
		));
		$this->dbforge->add_key("id",TRUE);
		$this->dbforge->create_table("usuariolivro");
		$this->db->query("ALTER TABLE usuariolivro ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(id);");
		$this->db->query("ALTER TABLE usuariolivro ADD FOREIGN KEY (livro_id) REFERENCES livros(id);");
		$this->db->query("ALTER TABLE usuariolivro ADD FOREIGN KEY (status_id) REFERENCES status_leitura(id);");
	}
	public function down(){
		$this->dbforge->drop_table("usuariolivro");
	}
}