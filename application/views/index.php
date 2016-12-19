<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <a href="livro/index">
                <img src="<?php echo base_url('img/slider1.png')?>" alt="Texto Slide 1">
                <div class="carousel-caption">
                    <h3>Harry Potter e a Criança Amaldiçoada</h3>
                    <p>Confira o novo livro da J.K. Rowling</p>
                </div>
            </a>
        </div>

        <div class="item">
            <a href="livro/index">
                <img src="<?php echo base_url('img/slider2.jpg')?>" alt="Texto Slide 2">
                <div class="carousel-caption">
                    <h3>Por que fazemos o que fazemos?</h3>
                    <p>O filósofo e escritor Mario Sergio Cortella desvenda em Por que fazemos o que fazemos? as principais preocupações com relação ao trabalho. </p>
                </div>
            </a>
        </div>

        <div class="item">
            <a href="livro/index">
                <img src="<?php echo base_url('img/slider3.png')?>" alt="Texto Slide 3">
                <div class="carousel-caption">
                    <h3>Baía da Esperança</h3>
                    <p>Novo Livro da Jojo Moyes, autora de diversos best-sellers</p>
                </div>
            </a>
        </div>
    </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="menu-generos">
            <h3>Gêneros</h3>
            <ul class="list-group">
                <?php foreach($generos as $genero): ?>
                <li class="list-group-item"><?=anchor("livro/listar?genero={$genero['id']}","{$genero['nome']}")?></li>
                <?php endforeach; ?>
                <li class="list-group-item active mostrarMais">Mostrar Mais</li>
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <div class="menu-livros">
            <h3>Principais Lançamentos</h3>
            <p>Confira os últimos lançamentos de livros</p>
            <div class="row">
            <?php foreach($livros as $livro): ?>
                <div class="col-md-2 col-xs-4 livro-item-menu">
                    <a href="livro/<?=$livro['livro_id']?>/<?=$livro['titulo']?>">
                        <figure>
                            <img src="<?php echo base_url('uploads/'.$livro['arquivo'])?>" alt="<?=$livro['titulo']?>">
                        </figure>
                    </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>