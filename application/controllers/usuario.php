<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario extends CI_Controller{
	/*Controller para Usuários. Essa Controller irá executar lógicas referentes a modelos Usuário e redirecioná-las
		para as Views Usuário correspondentes*/
	/*Método responsável pela listagem de usuários*/
	public function index(){
		$this->load->helper(array("date"));
		$this->load->model("usuario_model");
		$usuarios = $this->usuario_model->listar();
		$dadosURL = array('usuarios' => $usuarios);
		$this->load->view("usuarios/listagem.php",$dadosURL);
	}
	/*Método responsável por mostrar o formulário de inserção ou consulta de usuário*/
	public function formulario(){
		$this->load->template("usuarios/form-cadastro.php");
	}
	/*Método responsável por executar a lógica de adicionar usuário*/
	public function adicionar(){
		$this->load->model("usuario_model");
		$this->load->helper(array("date"));
		$validacao_ok = $this->validacao();
		$usuario = array('nome' => $this->input->post("nome"),
			'dataNasc' => $this->input->post("dataNasc"),
			'email' => $this->input->post("email"),
			'senha' => md5($this->input->post("senha")),
			'id' => ''
		);
		if($validacao_ok){
			$usuario['dataNasc'] = convertToAmerican($usuario['dataNasc']);
			$inseriu = $this->usuario_model->adicionar($usuario);
			if($inseriu){
				$this->session->set_flashdata("mensagem-sucesso","Usuário <strong>{$usuario['nome']}</strong> criado com sucesso");
			}else{
				$this->session->set_flashdata("mensagem-erro","Erro ao inserir usuário. Contate o desenvolvedor");
			}
			redirect('/');
		}else{
			$dados = array('usuario' => $usuario, 'modo_validacao' => 1);
			$this->load->template("usuarios/form-cadastro.php","GuiaLivros | Usuário",$dados);
		}
	}
	/*Método responsável por executar a lógica de autenticar, ou seja, verificar se um login é válido*/
	public function autenticar(){
		$this->load->model("usuario_model");
		$nome = $this->input->post("nome");
		$senha = md5($this->input->post("senha"));
		$usuario = $this->usuario_model->verificaLogin($nome,$senha);
		if($usuario){
			$this->session->set_flashdata("mensagem-sucesso","Usuário <strong>{$nome}</strong> logado com sucesso!");
			$this->session->set_userdata('usuario_logado',$usuario);
			redirect('/');
		}else{
			$this->session->set_flashdata("mensagem-erro","Usuário ou senha incorretos");
			redirect('/Welcome/login');
		}
		
	}
	/*realiza o logout do usuário*/
	public function logout(){
		$this->session->unset_userdata("usuario_logado");
		$this->session->set_flashdata("mensagem-sucesso","Usuário deslogado com sucesso!");
		redirect('/');
	}
	/*consulta os dados referentes a um usuário, preenchendo formulário para possível alteração*/
	public function consulta(){
		$this->load->helper("date");
		$this->load->model("usuario_model");
		$usuario_id = $this->input->post("usuario_id");
		$usuario = $this->usuario_model->consultar($usuario_id);
		$usuario['dataNasc'] = convertToBrazilian($usuario['dataNasc']);
		$dados = array('usuario' => $usuario,'modo_consulta' => 1);
		$this->load->template("usuarios/form-cadastro.php","GuiaLivros | Usuário",$dados);
	}
	/*efetua a atualização de dados cadastrais de um usuário*/
	public function atualizar(){
		$this->load->helper("date");
		$this->load->model("usuario_model");
		$validacao_ok = $this->validacao();
		$usuario = array('id' => $this->input->post('usuario_id'),
			'nome' => $this->input->post('nome'),
			'email' => $this->input->post('email'),
			'dataNasc' => $this->input->post("dataNasc"),
			'senha' => md5($this->input->post('senha'))
		);
		if($validacao_ok){
			$usuario['dataNasc'] = convertToAmerican($this->input->post('dataNasc'));
			$atualizou = $this->usuario_model->atualizar($usuario);
			if($atualizou){
				$this->session->set_flashdata("mensagem-sucesso","Perfil atualizado com sucesso!");
			}
			redirect('/');
		}
		else{
			$dados = array("usuario" => $usuario,"modo_consulta" => 1);
			$this->load->template("usuarios/form-cadastro.php","GuiaLivros | Usuário",$dados);
		}
	}
	/*valida o formulário enviado*/
	public function validacao(){		
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");
		$this->form_validation->set_rules("nome","nome","required");
		$this->form_validation->set_rules("dataNasc","Data de Nascimento","required|min_length[10]|max_length[10]");
		$this->form_validation->set_rules("email","email","required|valid_email");
		$this->form_validation->set_rules("senha","senha","required|min_length[5]");
		$this->form_validation->set_rules("confirmeSenha","de confirmação","matches[senha]");
		$resultado = $this->form_validation->run();
		return $resultado;
	}
}