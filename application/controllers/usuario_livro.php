<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario_Livro extends CI_Controller{
	/*magic method de autoload da classe*/
	public function __construct(){
		parent::__construct();
		$this->load->model("usuario_livro_model");
		$this->load->helper("date");
	}
	/*adiciona um registro na tabela usuariolivro, com usuario_id, livro_id, status e data*/
	public function adicionar(){
		$usuario = verificaLogin();
		$params = array(
			'livro_id' => $this->input->post("livro_id"),
			'usuario_id' => $usuario['id'],
			'status_id' => $this->input->post("status"),
			'data' => date("Y-m-d")
		);
		$titulo = $this->input->post("livro_nome");
		if($params['status_id'] != 100){
			$livro_existe = $this->usuario_livro_model->consulta($params['usuario_id'],$params['livro_id']);
			if($livro_existe != NULL){
				$this->usuario_livro_model->exclui($params['usuario_id'],$params['livro_id']);
			}
			$adicionou = $this->usuario_livro_model->adiciona($params);
			if($adicionou){
				$status = $this->usuario_livro_model->consultaStatus($params['usuario_id'],$params['livro_id']);
				$this->session->set_flashdata("mensagem-sucesso","Este livro foi adicionado como <strong>{$status['status_descricao']}</strong> em sua lista");
			}else{
				$this->session->set_flashdata("mensagem-erro","Falha ao adicionar este livro à sua lista");
			}
		}else{
			$this->usuario_livro_model->exclui($params['usuario_id'],$params['livro_id']);
			$this->session->set_flashdata("mensagem-sucesso","Este livro foi retirado da sua lista!");
		}
		if($this->input->post("isAjax") != 1){
			redirect('livro/'.$params['livro_id']."/".$titulo);	
		}
	}
	/*gera dados para os gráficos e outras estatísticas*/
	public function form_estatistica(){
		$usuarioLogado = verificaLogin();
		$filtro_pesquisa = $this->input->get("tipo-pesquisa");
		$resultados = array();
		$arquivo_json = array();
		if(isset($_GET['tipo-pesquisa']) && $filtro_pesquisa == "lidos_abandonados"){
			$filtro_pesquisa = "status";
		}
		// $validacao_ok = $this->validacao_form();
		if(isset($_GET['tipo-pesquisa'])){
			$datas = array('inicio' => '', 'fim' => '');
			if(isset($_GET['data-inicio']) && isset($_GET['data-fim'])){
				$datas['inicio'] = convertToAmerican($this->input->get("data-inicio"));
				$datas['fim'] = convertToAmerican($this->input->get("data-fim")); 
			}
			$resultados = $this->usuario_livro_model->criaEstatistica($usuarioLogado['id'],$filtro_pesquisa,$datas);
		}
		$resultados_paginas = $this->usuario_livro_model->estatisticaPaginaAno($usuarioLogado['id'],"paginas");
		$resultados_anos = $this->usuario_livro_model->estatisticaPaginaAno($usuarioLogado['id'],"ano");
		$dados = array("usuario_nome" => $usuarioLogado['nome'],'resultados' => $resultados,
			'resultados_paginas' => $resultados_paginas, 'resultados_ano' => $resultados_anos);
		$this->load->template("livros/estatisticas.php",$titulo = "GuiaLivros | Estatísticas",$dados);
	}
	public function validacao_form(){
		$this->form_validation->set_rules("tipo-pesquisa","tipo de pesquisa","required");
		$resultado = $this->form_validation->run();
		return $resultado;
	}
}