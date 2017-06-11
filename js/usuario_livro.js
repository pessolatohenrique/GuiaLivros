function vinculaLivro(livro_id,status_id,element){
	var action = "http://[::1]/Projetos/Livraria/index.php/usuario_livro/adicionar";
	var dados = {"livro_id":livro_id,"status":status_id,"isAjax":1};
	var mensagem = "Status do livro alterado com sucesso! Atualize a página para verificar as alterações";
	$.post(action,dados,function(data){
		efeitoFadeOut(element);
		adicionaCaixaSucesso(mensagem);
	}).error(function(){
		alert("Erro ao sincronizar. Contate o desenvolvedor!");
	})
}
function eventosUserLivro(){
	$(".dropdown-status-leitura li > a").on("click",function(event){
		event.preventDefault();
		var info_livro = $(this).parent().parent().parent().parent();
		var livro_id = info_livro.find(".livro_id").val();
		var status_id = $(this).attr("href");
		vinculaLivro(livro_id,status_id,info_livro);
	});
	$(".minimizaPainel").on("click",function(event){
		event.preventDefault();
		var link = $(this);
		var flagBootstrap = true;
		minimizaPainelTitulo(link,flagBootstrap);
	})
}
$(document).ready(function(){
	eventosUserLivro();
});