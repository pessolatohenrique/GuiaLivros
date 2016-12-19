<?php
/*funções que auxiliam nas páginas. Exemplo: paginação*/
function criaPaginacao($url,$total_linhas,$quantidade_paginas){
	$ci = get_instance();
	$ci->load->library('pagination');
	$config['base_url'] = $url;
	$config['total_rows'] = $total_linhas;
	$config['per_page'] = $quantidade_paginas;
	$config['full_tag_open'] = "<div class='link-paginacao'>Navegue nas páginas: ";
	$config['full_tag_close'] = "</div>";
	$quantidade = $config['per_page'];
	($ci->uri->segment(3) != "")?$inicio = $ci->uri->segment(3):$inicio=0;
	$ci->pagination->initialize($config);
	return $inicio;
}