<?php 
function verificaPesquisa($string){
	switch($string){
		case 'lidos_abandonados': $nova_string = "Status de Leitura"; break;
		case 'genero': $nova_string = "Gênero"; break;
		default: $nova_string = ucfirst($string); break;
	}
	return $nova_string;
} 
?>
<h1>Estatísticas</h1>
<p>Estatísticas geradas com base na lista de livros do usuário <strong><?=$usuario_nome?></strong></p>
<?php echo form_open("usuario_livro/form_estatistica",array("method" => "GET","id" => "formulario")); ?>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="tipo-pesquisa">Gerar gráficos</label>
			<select name="tipo-pesquisa" id="tipo-pesquisa" class="form-control">
				<option>Selecione</option>
				<option value="lidos_abandonados">Comparação Lidos VS. Abandonados</option>
				<option value="autor">Por autor</option>
				<option value="genero">Por gênero</option>
				<option value="editora">Por editora</option>
			</select>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label for="data-inicio">Data Inicial</label>
			<input type="text" name="data-inicio" id="data-inicio" class="form-control">
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label for="data-fim">Data Final</label>
			<input type="text" name="data-fim" id="data-fim" class="form-control">
		</div>
	</div>
	<div class="ajusta-botao">
		<button type="button" id="gera_grafico" class="btn btn-primary">Gerar gráficos</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</div>
</div>
<?php echo form_close(); ?>
<?php if(isset($_GET['tipo-pesquisa']) && count($resultados) == 0): ?>
	<p class="alert alert-info">Nenhuma estatística encontrada para este período. Refaça a busca!</p>
<?php endif; ?>
<?php if(isset($_GET['tipo-pesquisa']) && count($resultados) > 0): $titulo_coluna = verificaPesquisa($_GET['tipo-pesquisa']); ?>
<div class="panel panel-primary">
	<div class="panel-heading">Gráficos</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4">
				<table class="table table-bordered tabela-grafico">
					<tr>
						<th><?=$titulo_coluna?></th>
						<th>Quantidade</th>
						<th>Páginas</th>
					</tr>
					<?php foreach($resultados as $item):?>
					<tr>
						<td><?=$item['pesquisa_nome']?></td>
						<td><?=$item['total_pesquisa']?></td>
						<td><?=$item['paginas_pesquisa']?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
			<div class="col-md-8">
				<div id="grafico_barra"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div id="grafico_pizza"></div>
			</div>
			<div class="col-md-6">
				<div id="grafico-pizza-paginas"></div>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">Outras Estatísticas</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<strong>Maior número de páginas: </strong>
				<?=anchor("livro/{$resultados_paginas['primeiro']['livro_id']}/{$resultados_paginas['primeiro']['titulo']}"
				,"{$resultados_paginas['primeiro']['titulo']}")?>, com <?=$resultados_paginas['primeiro']['paginas'] ?> páginas
			</div>
			<div class="col-md-6">
				<strong>Menor número de páginas: </strong>
				<?=anchor("livro/{$resultados_paginas['ultimo']['livro_id']}/{$resultados_paginas['ultimo']['titulo']}"
				,"{$resultados_paginas['ultimo']['titulo']}")?>, com <?=$resultados_paginas['ultimo']['paginas'] ?> páginas
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<strong>Livro mais recente: </strong>
				<?=anchor("livro/{$resultados_ano['primeiro']['livro_id']}/{$resultados_ano['primeiro']['titulo']}"
				,"{$resultados_ano['primeiro']['titulo']}")?>, publicado em <?=$resultados_ano['primeiro']['ano'] ?>
			</div>
			<div class="col-md-6">
				<strong>Livro mais antigo: </strong>
				<?=anchor("livro/{$resultados_ano['ultimo']['livro_id']}/{$resultados_ano['ultimo']['titulo']}"
				,"{$resultados_ano['ultimo']['titulo']}")?>, publicado em <?=$resultados_ano['ultimo']['ano'] ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>