<section class="dashboard">
	<h1>Dashboard</h1>
	<section class="totais-dashboard">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-primary painelCustom">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-book fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">
									<?=sprintf("%02d",$valores_dashboard['total_concluidos'])?>
								</div>
								<div>Livros concluídos</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel">
									<a href="livro/index/porUsuario">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconePrimary">
									<a href="livro/index/porUsuario">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-green painelCustom">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-file-text-o fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">
									<?=sprintf("%02d",$valores_dashboard['total_paginas'])?>
								</div>
								<div>Páginas que foram lidas</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeGreen">
									<a href="livro/index/porUsuario">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeGreen">
									<a href="livro/index/porUsuario">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-yellow painelCustom">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-user fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">
									<?=sprintf("%02d",$valores_dashboard['total_autores'])?>
								</div>
								<div>Autores que foram lidos</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeYellow">
									<a href="usuario_livro/form_estatistica?tipo-pesquisa=autor&data-inicio=&data-fim=">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeYellow">
									<a href="usuario_livro/form_estatistica?tipo-pesquisa=autor&data-inicio=&data-fim=">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-red painelCustom">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-3">
								<i class="fa fa-archive fa-5x"></i>
							</div>
							<div class="col-md-9 text-right">
								<div class="destaquePainel">
									<?=sprintf("%02d",$valores_dashboard['total_generos'])?>
								</div>
								<div>Gêneros que foram lidos</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeRed">
									<a href="usuario_livro/form_estatistica?tipo-pesquisa=genero&data-inicio=&data-fim=">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeRed">
									<a href="usuario_livro/form_estatistica?tipo-pesquisa=genero&data-inicio=&data-fim=">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php 
	if(count($maiores_leituras) > 0): 
	?>
		<section class="maiores-leituras secaoDashboard">
			<h2>Maiores Leituras Realizadas
				<span class="icones-titulo">
					<a href="livro/index/porUsuario?ordenacao=paginas">
						<i class="fa fa-eye" aria-hidden="true"></i>
					</a>
					<a href="#" class="minimizaPainel">
						<i class="fa fa-caret-up" aria-hidden="true"></i>
					</a>

				</span>
			</h2>
			<ul>
			<?php
			foreach($maiores_leituras as $key => $val):
			?>
				<li>
					<a href="livro/<?=$val['livro_id']?>/<?=$val['titulo']?>">
						<figure>
							<img src="<?=base_url()?>/uploads/<?=$val['arquivo']?>" alt="<?=$val['titulo']?>">
							<figcaption>
								<?=$val['paginas']?> páginas
							</figcaption>
						</figure>
					</a>
				</li>
			<?php
			endforeach;
			?>
			</ul>
		</section>
	<?php
	endif;
	?>
	<section class="sugestoes-dashboard secaoDashboard">
		<h2>
			Sugestões de Leitura com base em <em><?=$livro_random[0]['titulo']?></em>
			<span class="icones-titulo">
				<a href="livro/index/porUsuario?ordenacao=paginas">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#" class="minimizaPainel">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		foreach($semelhantes as $key => $val):
		?>
			<li>
				<a href="livro/<?=$val['livro_id']?>/<?=$val['titulo']?>">
					<figure>
						<img src="<?=base_url()?>/uploads/<?=$val['arquivo']?>" alt="<?=$val['titulo']?>">
						<figcaption>
							<?=$val['paginas']?> páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endforeach;
		?>
		</ul>
	</section>
	<section class="autor-mais-lido secaoDashboard">
		<h2>
			Autor(a) mais lido: <?=$nome_autor?>
			<span class="icones-titulo">
				<a href="usuario_livro/form_estatistica?tipo-pesquisa=autor&data-inicio=&data-fim=">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#" class="minimizaPainel">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		foreach($livros_autor as $key => $val):
		?>
			<li>
				<a href="livro/<?=$val['livro_id']?>/<?=$val['titulo']?>">
					<figure>
						<img src="<?=base_url()?>/uploads/<?=$val['arquivo']?>" alt="<?=$val['titulo']?>">
						<figcaption>
							<?=$val['paginas']?> páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endforeach;
		?>
		</ul>
	</section>
	<section class="genero-mais-lido secaoDashboard">
		<h2>
			Gênero mais lido: <?=$nome_genero?>
			<span class="icones-titulo">
				<a href="usuario_livro/form_estatistica?tipo-pesquisa=genero&data-inicio=&data-fim=">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#" class="minimizaPainel">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		foreach($livros_genero as $key => $val):
		?>
			<li>
				<a href="livro/<?=$val['livro_id']?>/<?=$val['titulo']?>">
					<figure>
						<img src="<?=base_url()?>/uploads/<?=$val['arquivo']?>" alt="<?=$val['titulo']?>">
						<figcaption>
							<?=$val['paginas']?> páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endforeach;
		?>
		</ul>
	</section>
		<section class="autor-mais-lido secaoDashboard">
		<h2>
			Sugestões de leitura com base no gênero <em><?=$recomenda_genero?></em>
			<span class="icones-titulo">
				<a href="livro/index?ordenacao=genero">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#" class="minimizaPainel">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		foreach($genero_random as $key => $val):
		?>
			<li>
				<a href="livro/<?=$val['livro_id']?>/<?=$val['titulo']?>">
					<figure>
						<img src="<?=base_url()?>/uploads/<?=$val['arquivo']?>" alt="<?=$val['titulo']?>">
						<figcaption>
							<?=$val['paginas']?> páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endforeach;
		?>
		</ul>
	</section>
	<section class="livros-lidos-dashboard secaoDashboard">
		<h2>
			Livros que terminei de ler
			<span class="icones-titulo">
				<a href="livro/index/porUsuario?status_leitura=1">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#" class="minimizaPainel">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		foreach($livros_lidos as $key => $val):
		?>
			<li>
				<a href="livro/<?=$val['livro_id']?>/<?=$val['titulo']?>">
					<figure>
						<img src="<?=base_url()?>/uploads/<?=$val['arquivo']?>" alt="<?=$val['titulo']?>">
						<figcaption>
							<?=$val['paginas']?> páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endforeach;
		?>
		</ul>
	</section>
		<section class="livros-lendo-dashboard secaoDashboard">
		<h2>
			Livros que quero ler
			<span class="icones-titulo">
				<a href="livro/index/porUsuario?status_leitura=3">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#" class="minimizaPainel">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		foreach($livros_queroLer as $key => $val):
		?>
			<li>
				<a href="livro/<?=$val['livro_id']?>/<?=$val['titulo']?>">
					<figure>
						<img src="<?=base_url()?>/uploads/<?=$val['arquivo']?>" alt="<?=$val['titulo']?>">
						<figcaption>
							<?=$val['paginas']?> páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endforeach;
		?>
		</ul>
	</section>

</section>