<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		*{
			font-family: Verdana;
		}
	</style>
</head>
<body>
	<h3>Recomendação do usuário <?=$usuario['nome']?>(<?=$usuario['email']?>)</h3>
	<p>
		<strong>Livro: </strong><?=$livro['titulo']?><br>
		<strong>Autor: </strong><?=$livro['autor_nome']?><br>
		<strong>Gênero: </strong><?=$livro['genero_nome']?><br>
		<strong>Páginas: </strong><?=$livro['paginas']?><br>
		<strong>Lançamento: </strong><?=$livro['ano']?><br>
		<strong>Editora: </strong><?=$livro['editora_nome']?>
		<br>
		<strong>Sinopse: </strong>
		<?php echo auto_typography(html_escape($livro['sinopse'])); ?>
	</p>
</body>
</html>