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