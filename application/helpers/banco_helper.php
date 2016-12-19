<?php
/*Helper, criado pelo desenvolvedor, com funções para auxiliar na manipulação do banco de dados*/
function verifica_ordenacao($strOrdenacao){
	$ordenacao = array("campo" => "titulo","criterio" => "ASC");
	switch($strOrdenacao){
		case 'alfabetica': $ordenacao = array("campo" => "titulo","criterio" => "ASC");
		break;
		case 'autor': $ordenacao = array("campo" => "autor_nome","criterio" => "ASC");
		break;
		case 'genero': $ordenacao = array("campo" => "genero_nome","criterio" => "ASC");
		break;
		case 'editora': $ordenacao = array("campo" => "editora_nome","criterio" => "ASC");
		break;
		case 'paginas': $ordenacao = array("campo" => "main.paginas","criterio" => "DESC");
		break;
		case 'ano': $ordenacao = array("campo" => "main.ano","criterio" => "DESC");
		break;
	}
	return $ordenacao;
}