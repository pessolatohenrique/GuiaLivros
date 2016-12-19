<?php
$tituloPrincipal = "Cadastrar Livro";
$action = "livro/adicionar";
$textoBotao = "Salvar";
$labelPaginas = "Número de Páginas";
$method = "POST";
$nameAutor = "autor_id";
$nameGenero = "genero_id";
$nameEditora = "editora_id";
if(isset($_GET['modo']) && $_GET['modo'] == 'pesquisa'){
	$tituloPrincipal = "Pesquisar Livro";
	$action = "livro/listar";
	$textoBotao = "Pesquisar";
	$labelPaginas = "Páginas (maior que)";
	$method = "GET";
	$nameAutor = "autor";
	$nameGenero = "genero";
	$nameEditora = "editora";
}
?>

	<h1><?=$tituloPrincipal?></h1>
		<?php if($this->session->flashdata("mensagem-sucesso")): ?>
			<p class="alert alert-success"><?=$this->session->flashdata("mensagem-sucesso")?></p>
		<?php endif;?>
		<?php if($this->session->flashdata("mensagem-erro")): ?>
			<p class="alert alert-danger"><?=$this->session->flashdata("mensagem-erro")?></p>
		<?php endif;?>
		<?php echo form_open("{$action}",array("enctype"=>"multipart/form-data","method" => $method,"id" => "formulario-configura")); ?>
		<?php if(!isset($_GET["modo"])): ?>
			<div class="form-group">
				<label for="arquivo">Capa do Livro</label>
				<input type="file" id="arquivo" name="arquivo">
				<p class="help-block">Escolha uma imagem para representar a capa do livro</p>
			</div>
		<?php endif; ?>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="titulo">Título</label>
						<input type="text" name="titulo" id="titulo" class="form-control" 
						value="<?php echo set_value('titulo',''); ?>"autofocus>
						<?php echo form_error('titulo'); ?>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="ano">Ano de Lançamento</label>
						<input type="text" name="ano" id="ano" class="form-control" maxlength="4"
						value="<?php echo set_value('ano',''); ?>">
						<?php echo form_error('ano'); ?>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="paginas"><?=$labelPaginas?></label>
						<input type="text" name="paginas" id="paginas" class="form-control" maxlength="4"
						value="<?php echo set_value('paginas',''); ?>">
						<?php echo form_error('paginas'); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="autor_id">Autor</label>
						<select name="<?=$nameAutor?>" class="form-control">
							<option value="">Selecione</option>
							<?php foreach($autores as $autor): ?>
								<?php $selecao = $autor['id'] == $this->session->userdata('autor_valida')?"selected = 'selected'":""?>
								<option <?=$selecao?> value="<?=$autor['id']?>"><?=$autor['nome']?></option>
							<?php endforeach; ?>
						</select>
						<?php echo form_error('autor_id'); ?>
					</div>
				</div>				
				<div class="col-md-4">
					<div class="form-group">
						<label for="genero_id">Gênero</label>
						<select name="<?=$nameGenero?>" class="form-control">
							<option value="">Selecione</option>
							<?php foreach($generos as $genero): ?>
								<?php $selecao = $genero['id'] == $this->session->userdata('genero_valida')?"selected = 'selected'":""?>
								<option <?=$selecao?> value="<?=$genero['id']?>"><?=$genero['nome']?></option>
							<?php endforeach; ?>
						</select>
						<?php echo form_error('genero_id'); ?>
					</div>
				</div>				
				<div class="col-md-4">
					<div class="form-group">
						<label for="editora_id">Editora</label>
						<select name="<?=$nameEditora?>" class="form-control">
							<option value="">Selecione</option>
							<?php foreach($editoras as $editora): ?>
								<?php $selecao = $editora['id'] == $this->session->userdata('editora_valida')?"selected = 'selected'":""?>
								<option <?=$selecao?> value="<?=$editora['id']?>"><?=$editora['nome']?></option>
							<?php endforeach; ?>
						</select>
						<?php echo form_error('editora_id'); ?>
					</div>
				</div>
			</div>
			<?php if(!isset($_GET['modo'])): ?>
			<div class="row">
				<div class="col-md-12">
					<label for="sinopse">Sinopse</label><br>
					<textarea name="sinopse" id="sinopse" rows="4" class="form-control"><?php echo set_value('sinopse',''); ?></textarea>
				</div>
				<?php echo form_error('sinopse'); ?>
			</div>
			<br>
			<?php endif; ?>
			<button type="submit" class="btn btn-primary"><?=$textoBotao?></button>
			<button type="reset" class="btn btn-warning">Limpar</button>
		<?php echo form_close(); ?>
