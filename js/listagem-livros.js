/*Verifica se o total de resultados é igual à 1. Caso for, redireciona para a página desejada*/
function redirecionaPagina(qtdTitulos){
	var endereco = "";
	if(qtdTitulos == 1){
		endereco = document.getElementById("endereco_link").href;
		window.location.href = endereco;
	}
}
function enviaStatusLeitura(status_id){
	$("#status").val(status_id);
	document.getElementById("form_usuario_livro").submit();
}
$(document).ready(function(){
	var qtdTitulos = $(".listagem-item").length;
	redirecionaPagina(qtdTitulos);
	$(".dropdown-status li a").on("click",function(event){
		event.preventDefault();
		var status_id = $(this).attr("href");
		enviaStatusLeitura(status_id);
	});
});