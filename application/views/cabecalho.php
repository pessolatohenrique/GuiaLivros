<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $titulo_pagina; ?></title>
  <link rel="icon" href="<?php echo base_url('uploads/book.jpg')?>" type="image/gif" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-theme/jquery-ui-1.9.2.custom.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/dashboard.css')?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.12.1.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.10.4.custom.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/jquery.mask.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/utils.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/validacao.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/geral.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/form-livros.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/listagem-livros.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/usuario_livro.js')?>"></script>
  <script src="https://use.fontawesome.com/b17cc3a995.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <!-- Scripts do Google Charts !-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="<?php echo base_url('js/desenha-grafico-pizza-quantidade.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/desenha-grafico-pizza-paginas.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/desenha-grafico-barra.js')?>"></script>
  <!-- Fim dos Scripts do Google Charts !-->
  <script type="text/javascript" src="<?php echo base_url('js/estatisticas.js')?>"></script>
</head>
<body>
    <!-- ÁREA DO MENU !-->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?=anchor("Welcome","GuiaLivros",array("class" => "navbar-brand"))?>
          
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><?=anchor("Welcome","Home")?></li>
            <li><?=anchor("dashboard","Dashboard")?></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Livros<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><?=anchor("livro/index/porUsuario","Minha Lista")?></a></li>
                  <li><?=anchor("livro/index","Listar")?></li>
                  <li><?=anchor("livro/formulario","Adicionar Novo")?></a></li>
                  <li><?=anchor("livro/formulario?modo=pesquisa","Pesquisar")?></a></li>
                </ul>
            </li>
            </li>
            <li class="dropdown">
           		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Autores<span class="caret"></span></a>
    	          <ul class="dropdown-menu">
    	            <li><?=anchor("autor/index","Listar")?></li>
                  <li><?=anchor("autor/formulario","Adicionar Novo")?></li>
    	            <li><?=anchor("autor/formulario?modo=pesquisa","Pesquisar")?></li>       
    	          </ul>
            </li>
            <li><?=anchor("usuario_livro/form_estatistica","Gráficos e Estatísticas")?></li>
          </ul>

          <?php if($this->session->userdata("usuario_logado")): ?>
          <ul class="nav navbar-nav navbar-right">
            <li>
            	<?php echo form_open("usuario/consulta","id = 'form-usuario'"); ?>
            		<input type="hidden" name="usuario_id" value="<?=$_SESSION['usuario_logado']['id']?>">
            		<a href="#">
            			<span class="glyphicon glyphicon-user"></span>
            			<?=$_SESSION['usuario_logado']['nome']?>
            		</a>
            	<?php echo form_close(); ?>
            </li>
            <li><?=anchor("usuario/logout","Logout")?></li>
          </ul>
      	<?php endif; ?>
        <?php if(!$this->session->userdata("usuario_logado")): ?>

          <ul class="nav navbar-nav navbar-right">
            <li>
              <?=anchor("Welcome/login","Entrar");?>
            </li>
            <li><?=anchor("usuario/formulario","Cadastre-se")?></li>
          </ul>
        <?php endif; ?>
         <?php echo form_open("livro/listar",array("class"=>"navbar-form navbar-right","method" => "GET"));?>
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Pesquisar livro" name="titulo" id="titulo">
              </div>
              <button type="submit" class="btn btn-primary">Pesquisar</button>
         <?php echo form_close(); ?>
        </div>
      </div>
    </nav>
  <!-- FIM DA ÁREA DO MENU !-->
	<div class="container">