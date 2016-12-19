<?php
/*Helper, criado pelo desenvolvedor, com funções de autorização e permissão*/
function verificaLogin(){
	$ci = get_instance();
	$usuarioLogado = $ci->session->userdata("usuario_logado");
	if(!$usuarioLogado){
		$ci->session->set_flashdata("mensagem-erro","Você precisa estar logado para acessar esta página!");
		redirect('Welcome/login');
	}
	return $usuarioLogado;
}