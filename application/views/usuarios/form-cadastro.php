<?php
$id = "";
$nome = "";
$dataNasc = "";
$email = "";
$titulo = "Cadastre-se";
$action = "usuario/adicionar";
if(isset($modo_consulta) || isset($modo_validacao)){
	$id = $usuario['id'];
	$nome = $usuario['nome'];
	$email = $usuario['email'];
	$dataNasc = $usuario['dataNasc'];
}
if(isset($modo_consulta)){
	$titulo = "Alterar Cadastro";
	$action = "usuario/atualizar";
	// $dataNasc = convertToBrazilian($usuario['dataNasc']);
}
?>
		<h1><?=$titulo?></h1>
		<?php echo form_open("{$action}",array('id' => 'formulario-configura')); ?>
			<input type="hidden" name="usuario_id" value="<?=$id?>">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome" class="form-control" 
						value="<?=$nome?>">
						<?php echo form_error('nome'); ?>

					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="text" name="email" id="email" class="form-control"
						value="<?=$email?>">
						<?php echo form_error('email'); ?>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="dataNasc">Data de Nascimento</label>
						<input type="text" name="dataNasc" id="dataNasc" class="form-control" maxlength="10"
						value="<?=$dataNasc?>">
						<?php echo form_error('dataNasc'); ?>
					</div>
				</div>
			</div>
			<div class="row">

				<div class="col-md-4">
					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="password" name="senha" value="" id="senha" class="form-control"  />
						<?php echo form_error('senha'); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="confirmeSenha">Confirme a Senha</label>
						<input type="password" name="confirmeSenha" class="form-control">
						<?php echo form_error('confirmeSenha'); ?>
					</div>
				</div>
			</div>
			<button name="salvar" type="submit" value="salvar" id="salvar" class="btn btn-primary">Salvar</button>
			<button type="reset" class="btn btn-warning">Limpar</button>
		<?php echo form_close(); ?>
