<?php if($autor == NULL): ?>
	<h3>Ops...Página não encontrada. Refaça a sua busca</h3>
<?php endif; ?>
<?php if($autor != NULL): ?>
	<h1><?=html_escape($autor[0]['autor_nome'])?></h1>
	<p>
		<strong>Data de Nascimento: </strong><?=convertToBrazilian($autor[0]['dataNasc'])?><br>
		<strong>Biografia: </strong>
		<?=auto_typography(html_escape($autor[0]['biografia']))?>
	</p>
	<?php if($autor[0]['livro_id'] != NULL):?>
	<h3>Livros Publicados (<?=count($autor)?>)</h3>
	<div class="row">
	<?php foreach($autor as $item): ?>
		<div class="col-md-2">
			<div class="listagem-autor">
				<figure>
					<img src="http://[::1]/Projetos/Livraria/uploads/<?=$item['arquivo']?>">
					<figcaption>
						<?=anchor("livro/{$item['livro_id']}/{$item['livro_nome']}",$item['livro_nome'])?>
					</figcaption>
				</figure>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
	<?php endif; ?>
<?php endif; ?>
<?php //=anchor("livro/{$autor['livro_id']}/{$autor['livro_nome']}",$autor['livro_nome']) ?>

