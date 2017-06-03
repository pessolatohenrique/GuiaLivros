<?php 
if($this->session->flashdata("mensagem-sucesso")): ?>
<div class="alert alert-success">
	<p><?php echo $this->session->flashdata("mensagem-sucesso"); ?></p>
</div>
<?php endif; ?>
<div class="informacoes-livro">
	<div class="row">
		<div class="figura-livro col-md-2">
			<figure>
				<img src="<?php echo base_url('uploads/'.$livro['arquivo']); ?>">
				<figcaption><?=$livro['titulo']?></figcaption>
			</figure>
		</div>
		<div class="descricao-livro col-md-10">
			<h3><?=$livro['titulo']?></h3>
				<div class="row">
					<div class="col-md-3">
						<?php echo form_open("usuario_livro/adicionar",array('id' => 'form_usuario_livro')); ?>
						<input type="hidden" name="livro_id" value="<?=$livro['livro_id']?>">
						<input type="hidden" name="livro_nome" value="<?=$livro['titulo']?>">
						<input type="hidden" name="status" id="status">
						<div class="dropdown">
    						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    							<?php ($status_leitura['livro_id'] != "")?$texto_drop = "Marcado como: ".$status_leitura['descricao']:$texto_drop = "Adicionar na minha lista"?>
    							<?=$texto_drop?>
    							<span class="caret"></span>
    						</button>
    						<ul class="dropdown-menu dropdown-status">
  								<li><a href="1">Já Li</a></li>
    							<li><a href="2">Lendo</a></li>
    							<li><a href="3">Quero Ler</a></li>
    							<li><a href="4">Abandonei</a></li>
    							<?php if($status_leitura['livro_id'] != ""): ?>
    							<li><a href="100">Retirar da Lista</a></li>
    							<?php endif; ?>
    						</ul>
						</div>
						<?php echo form_close(); ?>
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-email">
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
							Recomendar a um amigo
						</button>
					</div>
				</div>
			<p>
				<strong>Autor: </strong><?=anchor("autor/{$livro['autor_id']}/{$livro['autor_nome']}",$livro['autor_nome'])?><br>
				<strong>Gênero: </strong><?=anchor("livro/listar?genero={$livro['genero_id']}",$livro['genero_nome'])?><br>
				<strong>Páginas: </strong><?=$livro['paginas']?><br>
				<strong>Lançamento: </strong><?=$livro['ano']?><br>
				<strong>Editora: </strong><?=anchor("livro/listar?editora={$livro['editora_id']}",$livro['editora_nome'])?>
				<br>
				<strong>Sinopse: </strong>
				<?php echo auto_typography(html_escape($livro['sinopse'])); ?>
			</p>
		</div>
	</div>
	<div class="row descricao-autor">
		<h4><?=html_escape($livro['autor_nome'])?></h4>
		<p>
			<strong>Data de Nascimento: </strong><?=convertToBrazilian($livro['autor_data'])?><br>
			<strong>Biografia: </strong>
			<?=auto_typography(html_escape($livro['autor_biografia']))?>
		</p>
	</div>
	<section class="leituras-semelhantes row">
		<h4>Sugestões de Leitura</h4>
		<p>Os leitores que leram este livro, também gostaram de:</p>
		<div class="row">
		<?php 
		foreach($semelhantes as $key => $val): ?>
			<div class="col-md-2 coluna-semelhantes">
				<a href="<?=base_url()?>index.php/livro/<?=$val['livro_id']?>/<?=$val['titulo']?>">
					<figure>
						<img src="http://[::1]/Projetos/Livraria/uploads/<?=$val['arquivo']?>" alt="<?=$val['titulo']?>" class="img-recomendacao">
						<figcaption><?=$val['titulo']?></figcaption>
					</figure>
				</a>
			</div>
		<?php 
		endforeach; 
		?>
		</div>
	</section>
</div>
<!-- Conteúdo do Modal !-->
<div id="form-email" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Recomendar Livro</h4>
      </div>
      <div class="modal-body">
        <p>Digite o e-mail para a recomendação</p>
        <?php echo form_open("livro/recomenda_email"); ?>
        <input type="hidden" name="livro_id" value="<?=$livro['livro_id']?>">
        <div class="form-group">
        	<label for="email">E-mail</label>
        	<input type="text" name="email" id="email" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary">Enviar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close();?>
    </div>
  </div>
</div>