<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Loader extends CI_Loader{
	public function template($endereco,$titulo = "GuiaLivros",$dados = array()){
		$ci = get_instance();
		$dadosHeader = array("titulo_pagina" => $titulo);
		$ci->load->view("cabecalho.php",$dadosHeader);
		$ci->load->view($endereco,$dados);
		$ci->load->view("rodape.php");
	}
}