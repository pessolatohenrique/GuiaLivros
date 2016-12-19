<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Editora extends CI_Controller{
	public function formulario(){
		verificaLogin();
		$this->load->template("outros/formulario-genero-editora","GuiaLivros | Editora | Gênero");
	}
	public function adicionar(){
		$this->load->model("editora_model");
		$this->form_validation->set_rules("nome","editora","required|min_length[4]");
		$validacao_ok = $this->form_validation->run();
		if($validacao_ok){
			$editora = array("nome" => html_escape($this->input->post("nome")));
			$adicionou = $this->editora_model->adicionar($editora);
			if($adicionou){
				$this->session->set_flashdata("mensagem-sucesso","Editora <strong>{$editora['nome']}</strong> adicionada com sucesso!");
			}else{
				$this->session->set_flashdata("mensagem-erro","Erro ao adicionar editora. Contate o desenvolvedor");
			}
			redirect('/editora/formulario');
		}else{
			$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");
			$this->load->template("outros/formulario-genero-editora.php", "GuiaLivros | Editora | Gênero");
		}
	}
}