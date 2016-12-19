<h1><?=$titulo_pagina?></h1>
<?php  ?>
<div class="row">
<?php if(count($livros) == 0): ?>
	<p class="alert alert-info">Nenhum livro encontrado. Refaça a pesquisa!</p>
<?php endif; ?>
<input type="hidden" name="endereco_paginacao" id="endereco_paginacao">
<?php //echo form_open($action_ordenacao, array("method" => "GET","id" => "form-ordenacao")); ?>
	<?php if(count($livros) > 0): ?>
		<?php if($tipo == "usuario"): ?>
			<!-- Já Li, Lendo, Quero Ler, Abandonei !-->
			<div class="row quantidade-leitura">
				<div class="col-md-2">
					<div class="well well-ja-li">
						<?php (isset($total_status[0]['total_status']))?$lido=$total_status[0]['total_status']:$lido=0; ?>
						Já Li: <a href="?status_leitura=1"><?php echo sprintf("%02d",$lido);?></a>
					</div>
				</div>
				<div class="col-md-2">
					<div class="well well-lendo">
						<?php (isset($total_status[1]['total_status']))?$lendo=$total_status[1]['total_status']:$lendo=0; ?>
						Lendo: <a href="?status_leitura=2"><?php echo sprintf("%02d",$lendo);?></a>
					</div>
				</div>
				<div class="col-md-2">
					<div class="well well-quero-ler">
						<?php (isset($total_status[2]['total_status']))?$queroLer=$total_status[2]['total_status']:$queroLer=0; ?>
						Quero Ler: <a href="?status_leitura=3"><?php echo sprintf("%02d",$queroLer);?></a>
					</div>
				</div>
				<div class="col-md-2">
					<div class="well well-abandonei">Abandonei: 
						<?php (isset($total_status[3]['total_status']))?$abandonei=$total_status[3]['total_status']:$abandonei=0; ?>
						<a href="?status_leitura=4"><?php echo sprintf("%02d",$abandonei);?></a>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="ordenacao">Ordenar por:</label>
				<select name="ordenacao" id="ordenacao" class="form-control">
					<?php 
					$lista_ordenacao = array('alfabetica' => 'Alfabetica','autor' => 'Autor','genero' => 'Gênero',
						'editora' => 'Editora','paginas' => 'Número de Páginas', 'ano' => 'Lançamento'
					);
					?>
					<option value="">Selecione</option>
					<?php foreach($lista_ordenacao as $key => $val): 
						($ordenacao_session == $key)?$selecao="selected":$selecao = "";
					?>
						<option value="<?=$key?>" <?php echo $selecao; ?>><?=$val?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php //echo form_close(); ?>
<?php if(isset($_GET['autor']) && count($_GET) == 1): ?>
<h4><?=html_escape($livros[0]['autor_nome'])?></h4>
<p>
	<strong>Data de Nascimento: </strong><?=convertToBrazilian($livros[0]['autor_data'])?><br>
	<strong>Biografia: </strong>
	<?=auto_typography(html_escape($livros[0]['autor_biografia']))?>
</p>
<?php endif; ?>
<?php foreach($livros as $livro): ?>
	<div class="col-md-4 listagem">
		<p class="listagem-item">
			<?php $caminho_arquivo = $livro['arquivo']; ?>
			<img src="<?php echo base_url('uploads/'.$caminho_arquivo)?>"><br>
			<h4>
				<?php $livro['titulo'] = substr($livro['titulo'], 0,41); ?>
				<?=anchor("livro/{$livro['livro_id']}/{$livro['titulo']}",$livro['titulo'],array('id' => 'endereco_link'))?>
			</h4>
			<strong>Autor: </strong>
			<?=anchor("livro/listar?autor={$livro['autor_id']}",$livro['autor_nome'])?><br>
			<strong>Gênero: </strong>
			<?=anchor("livro/listar?genero={$livro['genero_id']}",$livro['genero_nome'])?><br>
			<strong>Páginas: </strong><?=$livro['paginas']?><br>
			<strong>Lançamento: </strong><?=$livro['ano']?><br>
			<strong>Editora: </strong>
			<?=anchor("livro/listar?editora={$livro['editora_id']}",$livro['editora_nome'])?><br>
			<strong>Sinopse: </strong><?=substr($livro['sinopse'],0,80)." (...)"?>
			<button type="submit" class="btn btn-primary">Adicionar na Minha Lista</button>
		</p>
	</div>			
<?php endforeach; ?>
</div>
<?php if($paginacao){echo $paginacao;} ?>
<script type="text/javascript" src="<?php echo base_url('js/listagem-livros.js'); ?>"></script>