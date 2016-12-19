<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_cria_tabela_status_leitura extends CI_Migration{
	public function up(){
		/*id,descricao*/
		$this->dbforge->add_field(array(
			'id' => array('type' => 'INT','auto_increment' => TRUE),
			'descricao' => array('type'=> 'VARCHAR','constraint' => '15')
		));
		$this->dbforge->add_key("id",TRUE);
		$this->dbforge->create_table("status_leitura");
		$this->db->query("INSERT INTO status_leitura values (DEFAULT,'Já Li')");
		$this->db->query("INSERT INTO status_leitura values (DEFAULT,'Lendo')");
		$this->db->query("INSERT INTO status_leitura values (DEFAULT,'Quero Ler')");
		$this->db->query("INSERT INTO status_leitura values (DEFAULT,'Abandonei')");
	}
	public function down(){
		$this->dbforge->drop_table("status_leitura");
	}
}