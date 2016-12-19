<!DOCTYPE html>
<html>
<head>
	<title>Livraria | Usuarios</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css'); ?>">
</head>
<body>
	<div class="container">
		<h1>Listagem de Usuários</h1>
		<?php if($this->session->flashdata('mensagem-sucesso')): ?>
			<p class="alert alert-success"><?=$this->session->flashdata('mensagem-sucesso')?></p>
		<?php endif; ?>
		<?php if($this->session->flashdata('mensagem-erro')): ?>
			<p class="alert alert-danger"><?=$this->session->flashdata('mensagem-erro')?></p>
		<?php endif; ?>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Data de Nascimento</th>
					<th>E-mail</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($usuarios as $usuario): ?>
				<tr>
					<td><?=$usuario['nome']?></td>
					<td><?=convertToBrazilian($usuario['dataNasc'])?></td>
					<td><?=$usuario['email']?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</body>
</html>