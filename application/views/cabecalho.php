<!DOCTYPE html>
<html>
<head>
	<title><?php echo $titulo_pagina; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-theme/jquery-ui-1.9.2.custom.min.css')?>">
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.12.1.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.10.4.custom.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/jquery.mask.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/validacao.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/geral.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/form-livros.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/listagem-livros.js')?>"></script>
  <script src="https://use.fontawesome.com/b17cc3a995.js"></script>
  <!-- Scripts do Google Charts !-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="<?php echo base_url('js/desenha-grafico-pizza-quantidade.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/desenha-grafico-pizza-paginas.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/desenha-grafico-barra.js')?>"></script>
  <!-- Fim dos Scripts do Google Charts !-->
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
           	<li class="dropdown">
           		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Opções<span class="caret"></span></a>
    	          <ul class="dropdown-menu">
                  <li><?=anchor("usuario_livro/form_estatistica","Estatísticas")?></li>
                  <li><?=anchor("editora/formulario","Adicionar Editora/Gênero")?></li>
    	          </ul>
            </li>
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
        </div>
      </div>
    </nav>
  <!-- FIM DA ÁREA DO MENU !-->
	<div class="container">