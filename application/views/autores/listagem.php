<h1>Listagem de Autores</h1>
<?php if($this->session->flashdata('mensagem-sucesso')): ?>
	<p class="alert alert-success"><?=$this->session->flashdata('mensagem-sucesso')?></p>
<?php endif; ?>
<?php if($this->session->flashdata('mensagem-falha')): ?>
	<p class="alert alert-danger"><?=$this->session->flashdata('mensagem-falha')?></p>
<?php endif; ?> 
<?php if(count($autores) == 0): ?>
	<p class="alert alert-info">Nenhum autor encontrado na pesquisa</p>
<?php endif; ?>
<?php if(count($autores) == 1){redirect("autor/{$autores[0]['id']}/{$autores[0]['nome']}");} ?>
<?php if(count($autores) > 0 ):?>
<table class="table table-bordered table-hover"> 
	<thead>
		<tr>
			<th>Autor</th>
			<th>Total de Publicações</th>
			<th>Data de Nascimento</th>
			<th>Biografia</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($autores as $autor): ?>
		<tr>
			<td><?=anchor("autor/{$autor['id']}/{$autor['nome']}",$autor['nome'])?></td>
			<td><?=$autor['total_livros']?></td>
			<td><?=convertToBrazilian($autor['dataNasc'])?></td>
			<td><?=html_escape(substr($autor['biografia'],0,100))?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>
