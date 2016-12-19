
	<?php if($this->session->userdata('usuario_logado')): ?>
		<div class="alert alert-success">
			<p>Logado como 
				<strong>
					<?=$_SESSION['usuario_logado']['nome']?> (<?=$_SESSION['usuario_logado']['email']?>)
				</strong>
			</p>
		</div>
		<?=anchor("usuario/logout","Logout",array('class' => 'btn btn-primary'))?>
	<?php else: ?>
	<h2>Login</h2>
	<?php if($this->session->flashdata("mensagem-sucesso")): ?>
		<p class="alert alert-success"><?=$this->session->flashdata("mensagem-sucesso")?></p>
	<?php endif;?>
	<?php if($this->session->flashdata("mensagem-erro")): ?>
		<p class="alert alert-danger"><?=$this->session->flashdata("mensagem-erro")?></p>
	<?php endif;?>
<p>Primeiro acesso? Realize o <?=anchor("usuario/formulario","cadastro")?>!</p>
	<?php echo form_open("usuario/autenticar",array("id" => "formulario-configura")); ?>
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="nome">Usuário</label>
					<input type="text" name="nome" id="nome" class="form-control">
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" name="senha" id="senha" class="form-control">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Login</button>
	<?php echo form_close(); ?>
	<?php endif; ?>