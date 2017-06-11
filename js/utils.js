function efeitoFadeOut(element){
	$(element).fadeOut(700,function(){
		$(element).remove();
	})
}
function adicionaCaixaSucesso(mensagem){
	var div = $("<div>").addClass("alert").addClass("alert-success");
	div.text(mensagem);
	$(".container").prepend(div);
}
function alteraIconePainel(link){
	var icone = link.find("i");
	if(icone.hasClass("fa-caret-down")){
		icone.removeClass("fa-caret-down");
		icone.addClass("fa-caret-up");
	}else{
		icone.removeClass("fa-caret-up");
		icone.addClass("fa-caret-down");
	}
}
/*minimiza o painel com efeito em jQuery de slidedown*/
function minimizaPainel(link,flagBootstrap){
	var painel_heading = link.parent();
	var classe = ".panel-body";
	if(flagBootstrap == false){
		classe = ".painel_corpo";
	}
	var painel_body = painel_heading.siblings(classe);
	console.log(painel_body);
	painel_body.slideToggle(800);
	alteraIconePainel(link);
}
function minimizaPainelTitulo(link){
	var secao = $(link).parent().parent().parent();
	var lista = $(secao).find("ul");
	lista.slideToggle(800);
	alteraIconePainel(link);
}
function adicionaItemCombo(seletor,texto,valor){
	$(seletor).append($("<option>").text(texto).val(valor));
}