<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); 

class Autor extends CI_Controller{
	public function index(){
		$this->load->helper("date");
		$this->load->model("autor_model");
		$parametros['autor_nome'] = $this->input->get("nome");
		$dados = array("autores" => $this->autor_model->listar($parametros));
		$this->load->template("autores/listagem.php","GuiaLivros | Autor",$dados);
	}
	public function formulario(){
		verificaLogin();
		$configuracao = array('titulo' => 'Cadastro de Autores','action' => 'autor/adicionar','botao' => 'Salvar','metodo' => 'POST');
		if(isset($_GET['modo'])){
			$configuracao = array('titulo' => 'Pesquisa de Autores','action' => 'autor/index','botao' => "Pesquisar",'metodo' => 'GET');
		}
		$dados = array('configuracao' => $configuracao);
		$this->load->template("autores/form-autores.php","GuiaLivros | Autor",$dados);
	}
	public function adicionar(){
		$this->load->model("autor_model");
		$this->load->helper("date");
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");
		$this->form_validation->set_rules("nome","nome","required|min_length[5]");
		$this->form_validation->set_rules("dataNasc","dataNasc","required|min_length[10]|max_length[10]");
		$validacao_ok = $this->form_validation->run();
		if($validacao_ok){
			$autor = array('nome' => $this->input->post('nome'),
				'dataNasc' => convertToAmerican($this->input->post('dataNasc')),
				'biografia' => $this->input->post('biografia')
			);
			$inseriu = $this->autor_model->adicionar($autor);
			if($inseriu){
				$this->session->set_flashdata("mensagem-sucesso","Autor <strong>{$autor['nome']}</strong> inserido com sucesso!");
			}else{
				$this->session->set_flashdata("mensagem-erro","Erro ao inserir autor. Contate o desenvolvedor");
			}
			redirect('/autor');
		}else{
			$this->load->template("autores/form-autores.php","GuiaLivros | Autor");
		}
	}
	/*realiza a consulta de um autor*/
	public function consulta($autor_id,$nome){
		$this->load->helper("date");
		$this->load->model("autor_model");
		$autor = $this->autor_model->consultar($autor_id);
		$dados = array("autor" => $autor);
		$this->load->template("autores/consulta","GuiaLivros | Autor",$dados);
	}
	/*lista autores em formato JSON para possibilitar autocomplete*/
	public function listaJSON(){
		$this->load->model("autor_model");
		$autores = $this->autor_model->listaPorNome();
		$arquivo_json = json_encode($autores,JSON_UNESCAPED_UNICODE);
		echo $arquivo_json;
	}
}