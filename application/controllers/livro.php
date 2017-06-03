<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); 
class Livro extends CI_Controller{
	public function index(){
		$this->listar();
	}
	public function formulario(){
		verificaLogin();
		$this->session->unset_userdata('autor_valida');
		$this->session->unset_userdata('genero_valida');
		$this->session->unset_userdata('editora_valida');
		$dados = $this->preencheCombos();
		$this->load->template("livros/formulario.php","GuiaLivros | Livro", $dados);
	}
	public function adicionar(){
		$validacao_ok = $this->validacao();
		$this->load->model("livro_model");
		if($validacao_ok){
			$arquivo = $this->cria_arquivo($this->input->post("titulo"));			
			$livro = array('titulo' => html_escape($this->input->post('titulo')),
				'ano' => $this->input->post('ano'),
				'paginas' => $this->input->post('paginas'),
				'autor_id' => $this->input->post('autor_id'),
				'genero_id' => $this->input->post('genero_id'),
				'editora_id' => $this->input->post('editora_id'),
				'sinopse' => html_escape($this->input->post('sinopse')),
				'arquivo' => $arquivo
			);
			$inseriu = $this->livro_model->adicionar($livro);
			if($inseriu){
				$this->session->set_flashdata("mensagem-sucesso","O livro <strong>{$livro['titulo']}</strong> foi inserido com sucesso");
			}else{
				$this->session->set_flashdata("mensagem-erro","Erro ao inserir livro. Contate o desenvolvedor");
			}
			redirect('/livro/formulario');
		}else{
			$dados = $this->preencheCombos();
			$this->session->set_userdata('autor_valida',$this->input->post('autor_id'));
			$this->session->set_userdata('genero_valida',$this->input->post('genero_id'));
			$this->session->set_userdata('editora_valida',$this->input->post('editora_id'));
			$this->load->template("livros/formulario.php","GuiaLivros | Livro",$dados);
		}
	}
	public function listar(){
		$this->load->model(array("livro_model","usuario_livro_model"));
		$this->load->helper(array("date","banco","page"));
		$parametros = array(
			'autor_id' => $this->input->get("autor"), 
			'genero_id' => $this->input->get("genero"),
			'editora_id' => $this->input->get("editora"),
			'titulo' => $this->input->get("titulo"),
			'lancamento' => $this->input->get("ano"),
			'paginas' => $this->input->get("paginas"),
			'ordenacao' => verifica_ordenacao($this->input->get("ordenacao"))
		);
		/*Helper de paginação*/
		$quantidade = 12;
		$url = base_url()."index.php/livro/index";
		if($this->uri->segment(3) != "porUsuario"){
			$url = base_url()."index.php/livro/index";
			$total_linhas = $this->livro_model->numero_registros();
			$inicio = criaPaginacao($url,$total_linhas,$quantidade);
			$livros = $this->livro_model->listar($parametros,$quantidade,$inicio);
			$titulo_pagina = "Listagem de Livros";
			$tipo = "geral";
			$action_ordenacao = "livro/index";
			$total_linhas = count($livros);
			$titulo_pagina = "Listagem de Livros";
			$total_status = array();
		}else{
			$usuario = verificaLogin();
			$url = base_url()."index.php/livro/index/porUsuario";
			$parametros['usuario_id'] = $usuario['id'];
			$parametros['status_leitura'] = $this->input->get("status_leitura");
			// $parametros['ordenacao'] = verifica_ordenacao($this->input->get("ordenacao"));
			$total_linhas = $this->usuario_livro_model->numero_registros($parametros);
			$inicio = criaPaginacao($url,$total_linhas,$quantidade);
			$inicio = ($this->uri->segment(4) != "")?$inicio = $this->uri->segment(4):$inicio=0;
			$livros = $this->usuario_livro_model->listar($parametros,$quantidade,$inicio);
			$titulo_pagina = "Meus Livros";
			$tipo = "usuario";
			$action_ordenacao = "livro/index/porUsuario";
			$total_status = $this->usuario_livro_model->consultaTotalPorStatus($usuario['id']);
		}		
		/*Fim do helper de paginação*/		
		$dados = array('livros' => $livros,'paginacao' => $this->pagination->create_links(),'titulo_pagina' => $titulo_pagina, 'action_ordenacao' => $action_ordenacao, 'tipo' => $tipo,'total_status' => $total_status);
		$this->load->template("livros/listagem","GuiaLivros | Livro",$dados);
	}
	public function consulta($id){
		$this->load->helper("date");
		$this->load->model(array("livro_model","usuario_livro_model"));
		$usuario = verificaLogin();
		$livro = $this->livro_model->consultar($id);
		$semelhantes = $this->livro_model->listaSemelhantes($livro,7);
		$status_leitura = $this->usuario_livro_model->consulta($usuario['id'],$livro['livro_id']);
		$dados = array('livro' => $livro,'status_leitura' => $status_leitura,'semelhantes' => $semelhantes);
		$this->load->template("livros/consulta","GuiaLivros | {$livro['titulo']}",$dados);
	}
	/*envia e-mail com recomendação de um livro*/
	public function recomenda_email(){
		$this->load->model("livro_model");
		$email_recomendacao = $this->input->post("email");
		$usuarioLogado = $this->session->userdata("usuario_logado");
		$livro_id = $this->input->post("livro_id");
		$livroBusca = $this->livro_model->consultar($livro_id);
		$dados = array('livro' => $livroBusca, 'usuario' => $usuarioLogado);
		$conteudo = $this->load->view("livros/recomendacao",$dados,TRUE);
		$this->load->library("email");
		$this->email->from("guialivrosoficial@gmail.com", 'GuiaLivros');
		$this->email->subject("O usuário {$usuarioLogado['nome']} te recomendou o livro {$livroBusca['titulo']}");
		$this->email->to($email_recomendacao); 
		$this->email->message($conteudo);
		$enviou = $this->email->send();
		if($enviou){
			$this->session->set_flashdata("mensagem-sucesso","E-mail de recomendação enviado com sucesso");
			redirect("/livro/{$livroBusca['livro_id']}/{$livroBusca['titulo']}");
		}else{
			echo $this->email->print_debugger();
		}
	}
	public function preencheCombos(){
		$this->load->model("autor_model");
		$this->load->model("genero_model");
		$this->load->model("editora_model");
		$autores = $this->autor_model->listar();
		$generos = $this->genero_model->listar();
		$editoras = $this->editora_model->listar();
		$dados = array('autores' => $autores, 'generos' => $generos, 'editoras' => $editoras);
		return $dados;
	}
	public function validacao(){
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");
		$this->form_validation->set_rules("titulo","titulo","required|min_length[4]");
		$this->form_validation->set_rules("ano","ano","required|min_length[4]|max_length[4]");
		$this->form_validation->set_rules("paginas","paginas","required|min_length[2]|max_length[4]");
		$this->form_validation->set_rules("autor_id","autor","required");
		$this->form_validation->set_rules("genero_id","gênero","required");
		$this->form_validation->set_rules("editora_id","editora","required");
		$this->form_validation->set_rules("sinopse","sinopse","required|trim|min_length[10]");
		return $this->form_validation->run();
	}
	/*cria um arquivo com a imagem - capa do livro*/
	public function cria_arquivo($titulo){
        /*Tratamento de imagem gerada*/
        if(isset($_FILES["arquivo"])){
            $extensao = substr($_FILES["arquivo"]["name"], -4);
            $extensao = strtolower($extensao);
            $novo_nome = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $titulo.$extensao)); 
            $novo_nome = retirarAcentos($novo_nome);
            $diretorio = './uploads/';
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
            return $novo_nome;
        }
	}
	/*pesquisa os livros e retorna arquivo JSON para autocomplete*/
	public function livrosJSON(){
		$this->load->model("livro_model");
		$livros = $this->livro_model->listaPorNome();
		$arquivo_json = json_encode($livros,JSON_UNESCAPED_UNICODE);
		echo $arquivo_json;
	}
	/*adiciona um autor via AJAX. Deste modo é possível adicionar autores em outros formulários, como o de livros*/
	public function adicionaAutor(){
		$this->load->model("autor_model");
		$this->load->helper("date");
		$autor = array('nome' => $this->input->post('nome'),
			'dataNasc' => convertToAmerican($this->input->post('dataNasc')),
			'biografia' => $this->input->post('biografia')
		);
		$inseriu = $this->autor_model->adicionar($autor);
		echo $this->db->insert_id();
	}
	/*adiciona um gênero via AJAX. Deste modo é possível adicionar gêneros em outros formulários, como o de livros*/
	public function adicionaGenero(){
		$this->load->model("genero_model");
		$genero = array("nome" => $this->input->post("genero"));
		$inseriu = $this->genero_model->adicionar($genero);
		echo $this->db->insert_id();
	}
	/*adiciona uma editora via AJAX. Deste modo é possível adicionar editoras em outros formulários, como o de livros*/
	public function adicionaEditora(){
		$this->load->model("editora_model");
		$editora = array("nome" => $this->input->post("editora"));
		$inseriu = $this->editora_model->adicionar($editora);
		echo $this->db->insert_id();
	}
}