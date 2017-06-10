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
								<div class="destaquePainel">03</div>
								<div>Livros concluídos</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel">
									<a href="#">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconePrimary">
									<a href="#">
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
								<div class="destaquePainel">1000</div>
								<div>Páginas que foram lidas</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeGreen">
									<a href="http://localhost:8000/historicoConsulta">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeGreen">
									<a href="http://localhost:8000/historicoConsulta">
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
								<div class="destaquePainel">10</div>
								<div>Autores que foram lidos</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeYellow">
									<a href="http://localhost:8000/exame">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeYellow">
									<a href="http://localhost:8000/exame">
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
								<div class="destaquePainel">10</div>
								<div>Gêneros que foram lidos</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-10">
								<span class="detalhesPainel iconeRed">
									<a href="http://localhost:8000/pagamento">Ver Detalhes</a>
								</span>
							</div>
							<div class="col-md-2">
								<span class="iconeDetalhePainel iconeRed">
									<a href="http://localhost:8000/pagamento">
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
	<section class="maiores-leituras secaoDashboard">
		<h2>Maiores Leituras Realizadas
			<span class="icones-titulo">
				<a href="#">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		for($i = 1; $i <= 7; $i++):
		?>
			<li>
				<a href="#">
					<figure>
						<img src="<?=base_url()?>/uploads/Alasca.jpg" alt="Título do livro">
						<figcaption>
							<strong>Título do livro</strong><br>
							52 páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endfor;
		?>
		</ul>
	</section>
	<section class="sugestoes-dashboard secaoDashboard">
		<h2>
			Sugestões de Leitura
			<span class="icones-titulo">
				<a href="#">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		for($i = 1; $i <= 7; $i++):
		?>
			<li>
				<a href="#">
					<figure>
						<img src="<?=base_url()?>/uploads/A Ameaca Invisivel.jpg" alt="Título do livro">
						<figcaption>
							<strong>Título do livro</strong><br>
							52 páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endfor;
		?>
		</ul>
	</section>
	<section class="autor-mais-lido secaoDashboard">
		<h2>
			Autor(a) mais lido: J.K Rowling
			<span class="icones-titulo">
				<a href="#">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		for($i = 1; $i <= 7; $i++):
		?>
			<li>
				<a href="#">
					<figure>
						<img src="<?=base_url()?>/uploads/Harry Potter e a Pedra Filosofal.jpg" alt="Título do livro">
						<figcaption>
							<strong>Título do livro</strong><br>
							52 páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endfor;
		?>
		</ul>
	</section>
	<section class="genero-mais-lido secaoDashboard">
		<h2>
			Gênero mais lido: Fantasia
			<span class="icones-titulo">
				<a href="#">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		for($i = 1; $i <= 7; $i++):
		?>
			<li>
				<a href="#">
					<figure>
						<img src="<?=base_url()?>/uploads/Harry Potter e o Prisioneiro de Azkaban.jpg" alt="Título do livro">
						<figcaption>
							<strong>Título do livro</strong><br>
							52 páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endfor;
		?>
		</ul>
	</section>
		<section class="autor-mais-lido secaoDashboard">
		<h2>
			Editora mais lida: Rocco
			<span class="icones-titulo">
				<a href="#">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		for($i = 1; $i <= 7; $i++):
		?>
			<li>
				<a href="#">
					<figure>
						<img src="<?=base_url()?>/uploads/Scrum.jpg" alt="Título do livro">
						<figcaption>
							<strong>Título do livro</strong><br>
							52 páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endfor;
		?>
		</ul>
	</section>
	<section class="livros-lidos-dashboard secaoDashboard">
		<h2>
			Livros que realizei a leitura
			<span class="icones-titulo">
				<a href="#">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		for($i = 1; $i <= 7; $i++):
		?>
			<li>
				<a href="#">
					<figure>
						<img src="<?=base_url()?>/uploads/A Culpa e das Estrelas.jpg" alt="Título do livro">
						<figcaption>
							<strong>Título do livro</strong><br>
							52 páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endfor;
		?>
		</ul>
	</section>
		<section class="livros-lendo-dashboard secaoDashboard">
		<h2>
			Livros que quero ler
			<span class="icones-titulo">
				<a href="#">
					<i class="fa fa-eye" aria-hidden="true"></i>
				</a>
				<a href="#">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
				</a>

			</span>
		</h2>
		<ul>
		<?php
		for($i = 1; $i <= 7; $i++):
		?>
			<li>
				<a href="#">
					<figure>
						<img src="<?=base_url()?>/uploads/Qual a tua obra.jpg" alt="Título do livro">
						<figcaption>
							<strong>Título do livro</strong><br>
							52 páginas
						</figcaption>
					</figure>
				</a>
			</li>
		<?php
		endfor;
		?>
		</ul>
	</section>

</section>