<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*Controller utilizado na página inicial*/
class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
}
