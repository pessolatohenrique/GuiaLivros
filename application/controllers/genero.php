<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Genero extends CI_Controller{
	public function adicionar(){
		$this->load->model("genero_model");
		$genero = array("nome" => html_escape($this->input->post("nome")));
		$adicionou = $this->genero_model->adicionar($genero);		
		if($adicionou){
			$this->session->set_flashdata("mensagem-sucesso","O gênero <strong>{$genero['nome']}</strong> foi adicionado com sucesso!");
		}else{
			$this->session->set_flashdata("mensagem-erro","Erro ao adicionar gênero. Contate o desenvolvedor");
		}
		redirect('/editora/formulario');
	}
}