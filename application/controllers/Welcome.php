<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*Controller utilizado na página inicial*/
class Welcome extends CI_Controller {
	/*magic method de autoload da classe*/
	public function __construct(){
		parent::__construct();
		$this->load->model("genero_model");
		$this->load->model("livro_model");
	}
	public function index()
	{
		$this->load->helper('url');
		$generos = $this->genero_model->listar();
		$parametros = $this->limpaParametros();
		$livros = $this->livro_model->listar($parametros,12);
		$dados = array("generos" => $generos, "livros" => $livros);
		$this->load->template('index',"GuiaLivros | Home",$dados);
	}
	public function login(){
		$this->load->template("login","GuiaLivros | Login");
	}
	public function limpaParametros(){
		$parametros = array();
		$parametros['autor_id'] = "";
		$parametros['genero_id'] = "";
		$parametros['editora_id'] = "";
		$parametros['titulo'] = "";
		$parametros["lancamento"] = "";
		$parametros["paginas"] = "";
		$parametros['ordenacao']['campo'] = "ano";
		$parametros['ordenacao']['criterio'] = "DESC";
		return $parametros;
	}
	public function dashboard(){
		$dados = array();
		$this->load->template("dashboard","GuiaLivros | Dashboard",$dados);
	}
}
