<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_cria_tabela_editora extends CI_Migration{
	public function up(){
		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT','auto_increment' => TRUE),
			'nome' =>array('type' => 'VARCHAR', 'constraint' => '40', 'null' => FALSE)
		));
		$this->dbforge->add_key("id",TRUE);
		$this->dbforge->create_table("editoras");
	}
	public function down(){
		$this->dbforge->drop_table("editoras");
	}
}