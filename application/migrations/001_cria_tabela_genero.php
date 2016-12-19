<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_cria_tabela_genero extends CI_Migration{
	public function up(){
		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT', 'auto_increment' => TRUE),
			'nome' => array('type' => 'VARCHAR', 'constraint' => '25', 'null' => FALSE)
		));
		$this->dbforge->add_key("id",TRUE);
		$this->dbforge->create_table("generos");
	}
	public function down(){
		$this->dbforge->drop_table("generos");
	}
}