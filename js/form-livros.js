/*limpa a URL, de modo a não concatenar vários parâmetros URL*/
function limpaURL(endereco){
	var endereco_cortado = endereco;
	if(endereco.indexOf("&") != -1){
		var split = endereco.split("&");
		endereco_cortado = split[0];
	}
	return endereco_cortado;
}
/*Concatena a ordenação com a página atual (seja ela de listagem geral, minha lista ou subtipos)*/
function criaOrdenacao(ordenar_por){
	var endereco = window.location.href;
	var endereco_formatado = limpaURL(endereco);
	var novo_endereco = "";
	if(endereco.indexOf("?") != -1){
		novo_endereco = endereco_formatado + "&ordenacao=" + ordenar_por;
	}else{
		novo_endereco = endereco_formatado + "?ordenacao=" + ordenar_por;
	}
	window.location.href = novo_endereco;
}
/*algumas funções de validação estão em js/validacao.js*/
$(document).ready(function(){
	$("#ordenacao").on("change",function(){
		var ordenar_por = $(this).val();
		criaOrdenacao(ordenar_por);
	});
	$("#gera_grafico").on("click",function(event){
		var pesquisa = $("#tipo-pesquisa").val();
		var campos_valida = [];
		campos_valida[0] = validaCampo("tipo-pesquisa",pesquisa);
		verificaEnvio(campos_valida);
	});
});	