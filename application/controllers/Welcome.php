<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*Controller utilizado na página inicial*/
class Welcome extends CI_Controller {
	/*magic method de autoload da classe*/
	public function __construct(){
		parent::__construct();
		$this->load->model("genero_model");
		$this->load->model("livro_model");
		$this->load->model("usuario_livro_model");
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
		$usuario = verificaLogin();
		$usuario_id = $usuario['id'];
		/*parâmetros de quantidade e ordenação*/
		$datas['inicio'] = ""; $datas['fim'] = "";
		$autor_mais_lido = $this->usuario_livro_model->criaEstatistica($usuario_id,"autor",$datas,1);
		$genero_mais_lido = $this->usuario_livro_model->criaEstatistica($usuario_id,"genero",$datas,1);
		$params = $this->configuraParams($usuario_id,"paginas","DESC",0,"");
		$params_random = $this->configuraParams($usuario_id,"paginas","DESC",1,"");
		$params_autor = $this->configuraParams($usuario_id,"paginas","DESC",1,$autor_mais_lido[0]['autor_id']);
		$params_genero = $this->configuraParams($usuario_id,"paginas","DESC",1,"",$genero_mais_lido[0]['genero_id']);
		$params_lidos = $this->configuraParams($usuario_id,"paginas","DESC",1,"","");
		$params_queroLer = $this->configuraParams($usuario_id,"paginas","DESC",1,"","");
		$params_queroLer['status_leitura'] = 3;
		$quantidade = 7;
		$qtd_random = 1;
		$inicio = 0;
		/*fim de parâmetros de quantidade e ordenação*/
		$livro_random = $this->usuario_livro_model->listar($params_random,$qtd_random,$inicio);
		$genero_random = $this->genero_model->listaRelLivro($usuario_id,1);
		$genero_random = $genero_random[0];
		$params_gen_random = $this->configuraParams($usuario_id,"paginas","DESC",1,"",$genero_random['id']);
		$livro_gen_random = $this->usuario_livro_model->listar($params_gen_random,$qtd_random,$inicio);
		$dados = array(
			"valores_dashboard" => $this->usuario_livro_model->criaEstatisticaDashboard($usuario_id),
			"maiores_leituras" => $this->usuario_livro_model->listar($params,$quantidade,$inicio),
			"livro_random" => $livro_random,
			"semelhantes" => $this->livro_model->listaSemelhantes($livro_random[0],$quantidade),
			'nome_autor' => $autor_mais_lido[0]['pesquisa_nome'],
			"livros_autor" => $this->usuario_livro_model->listar($params_autor,$quantidade,$inicio),
			"nome_genero" => $genero_mais_lido[0]['pesquisa_nome'],
			"livros_genero" => $this->usuario_livro_model->listar($params_genero,$quantidade,$inicio),
			"recomenda_genero" => $genero_random['genero_nome'],
			"genero_random" => $this->livro_model->listaSemelhantes($livro_gen_random[0],$quantidade),
			"livros_lidos" => $this->usuario_livro_model->listar($params_lidos,$quantidade,$inicio),
			"livros_queroLer" => $this->usuario_livro_model->listar($params_queroLer,$quantidade,$inicio)
		);
		$this->load->template("dashboard","GuiaLivros | Dashboard",$dados);
	}
	public function configuraParams($usuario_id,$ordenacao,$criterio,$aleatorio,$autor_id,$genero_id=""){
		$params = array();
		$params['usuario_id'] = $usuario_id;
		$params['ordenacao']['campo'] = $ordenacao;
		$params['ordenacao']['criterio'] = $criterio;
		$params['aleatorio'] = $aleatorio;
		$params['autor_id'] = $autor_id;
		$params['genero_id'] = $genero_id;
		return $params;
	}
}
