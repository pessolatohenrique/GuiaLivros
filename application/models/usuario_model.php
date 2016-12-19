<?php
class Usuario_model extends CI_Model{
	function adicionar($usuario){
		$resultado = $this->db->insert("usuarios",$usuario);
		return $resultado;
	}
	function listar(){
		$this->db->order_by("nome","ASC");
		$usuarios = $this->db->get("usuarios")->result_array();
		return $usuarios;
	}
	function verificaLogin($nome,$senha){
		$this->db->where("nome",$nome);
		$this->db->where("senha",$senha);
		$usuario = $this->db->get("usuarios")->row_array();
		return $usuario;
	}
	function consultar($id){
		$this->db->where("id",$id);
		$usuario = $this->db->get("usuarios")->row_array();
		return $usuario;
	}
	function atualizar($usuario){
		$this->db->where("id",$usuario['id']);
		$atualizou = $this->db->update("usuarios",$usuario);
		return $atualizou;
	}
}