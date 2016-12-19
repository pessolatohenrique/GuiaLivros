<?php function verificaMensagens(){
	if($this->session->flashdata('mensagem-sucesso')): ?>
		<p class="alert alert-success"><?=$this->session->flashdata('mensagem-sucesso')?></p>
	<?php endif; ?>
	<?php if($this->session->flashdata('mensagem-falha')): ?>
		<p class="alert alert-danger"><?=$this->session->flashdata('mensagem-falha')?></p>
	<?php endif; 
}?>
