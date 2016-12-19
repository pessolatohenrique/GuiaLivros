		<h1>Cadastro de Editoras/Gêneros</h1>
		<?php echo validation_errors(); ?>
	  	<ul class="nav nav-pills">
    		<li class="active"><a data-toggle="tab" href="#editora">Editora</a></li>
    		<li><a data-toggle="tab" href="#genero">Gênero</a></li>
  		</ul>
  		<div class="tab-content">
  			<div id="editora" class="tab-pane fade in active">
  				<h3>Cadastrar Editora</h3>
  				<?php if($this->session->flashdata("mensagem-sucesso")): ?>
  					<p class="alert alert-success"><?=$this->session->flashdata("mensagem-sucesso")?></p>
  				<?php endif; ?>
  				<?php if($this->session->flashdata("mensagem-erro")): ?>
  					<p class="alert alert-danger"><?=$this->session->flashdata("mensagem-erro")?></p>
  				<?php endif; ?>
  				<?php echo form_open("editora/adicionar",array('id' => 'formulario-configura')); ?>
  				<div class="row">
  					<div class="col-md-10">
		  				<div class="form-group">
		  					<label for="nome">Editora</label>
		  					<input type="text" name="nome" id="nome" class="form-control" 
		  					value="<?php echo set_value('nome','')?>">
		  					<?php echo form_error("nome"); ?>
		  				</div>
		  			</div>
		  		</div>
  				<button type="submit" class="btn btn-primary">Adicionar</button>
  				<button type="reset" class="btn btn-warning">Limpar</button>
  				<?php echo form_close();?>
  			</div>
  			<div id="genero" class="tab-pane fade">
  				<h3>Cadastrar Gênero</h3>
  				<?php echo form_open("genero/adicionar"); ?>
  				<div class="row">
  					<div class="col-md-10">
  						<div class="form-group">
  							<label for="nome">Gênero</label>
  							<input type="text" name="nome" id="nome" class="form-control">
  						</div>
  					</div>
  				</div>
  				<button type="submit" class="btn btn-primary">Adicionar</button>
  				<button type="reset" class="btn btn-warning">Limpar</button>
  				<?php echo form_close(); ?>
  			</div>
  		</div>