<h1><?=$configuracao['titulo']?></h1>
<?php echo form_open($configuracao['action'],array('method' => $configuracao['metodo'],'id' => 'formulario-configura')); ?>
	<div class="row">
		<div class="col-md-10">
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" name="nome" id="nome" class="form-control"
				value="<?php echo set_value('nome'); ?>">
				<?php echo form_error('nome'); ?>
			</div>
		</div>
		<?php if($configuracao['action'] == "autor/adicionar"): ?>
		<div class="col-md-2">
			<div class="form-group">
				<label for="dataNasc">Data de Nascimento</label>
				<input type="text" name="dataNasc" id="dataNasc" class="form-control"
				value="<?php echo set_value('dataNasc'); ?>">
			</div>
			<?php echo form_error('dataNasc'); ?>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="biografia">Biografia</label>
				<textarea class="form-control" rows="4" name="biografia"></textarea>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<button type="submit" class="btn btn-primary"><?=$configuracao['botao']?></button>
	<button type="button" class="btn btn-warning">Limpar</button>
<?php echo form_close(); ?>
