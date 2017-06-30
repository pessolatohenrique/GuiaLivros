<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		*{
			font-family: Verdana, Arial, sans-serif;
		    width: 95%;
    		margin: 0 auto;
		}
		h3{
			padding-bottom: 0.5em;
		}
		p{
			padding-bottom: 1em;
		}
	</style>
</head>
<body>
	<h3>Recomendação do usuário <?=$usuario['nome']?><br>
		<?=$usuario['email']?>
	</h3>
	<br>
	<p>
		<strong>Livro: </strong><?=$livro['titulo']?><br>
		<strong>Autor: </strong><?=$livro['autor_nome']?><br>
		<strong>Gênero: </strong><?=$livro['genero_nome']?><br>
		<strong>Páginas: </strong><?=$livro['paginas']?><br>
		<strong>Lançamento: </strong><?=$livro['ano']?><br>
		<strong>Editora: </strong><?=$livro['editora_nome']?>
		<br>
		<strong>Sinopse: </strong><br>
		<?php echo auto_typography(html_escape($livro['sinopse'])); ?>
	</p>
	<p>
		Gostaria de conhecer mais livros, gerenciar a sua estante e visualizar estatísticas? Conheça o <a href="http://www.guialivrosoficial.com.br/index.php/Welcome">GuiaLivros</a>
	</p>
</body>
</html>