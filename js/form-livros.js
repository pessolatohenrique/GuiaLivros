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
/*adiciona item na combobox dinamicamente, alterando id, nome e selecionando o valor da combo*/
function adicionaCombo(seletor_id,vetor){
	$("#"+seletor_id).append($("<option></option>").attr("value",vetor[seletor_id]).text(vetor['nome']).attr("selected","selected"));
}
/*adiciona um autor no banco de dados através do formulário de livros*/
function adicionaAutorBanco(vetor){
	console.log(vetor);
	$.ajax({
		url:"adicionaAutor",
		data: {"nome":vetor['nome'],"dataNasc":vetor['dataNasc'],"biografia":vetor['biografia']},
		method: "POST",
		dataType: "json",
		success: function(data){
			var vetAutor = [];
			vetAutor['autor_id'] = data;
			vetAutor['nome'] = vetor['nome'];
			adicionaCombo("autor_id",vetAutor);
			$("#addAutor").modal("hide");
		},
		error: function(){
			alert("Erro ao adicionar autor por este form. Contate o desenvolvedor");
		}
	})
}
/*adiciona um gênero no banco de dados através do formulário de livros*/
function adicionaGeneroBanco(vetor){
	$.ajax({
		url: "adicionaGenero",
		data: {"genero":vetor['genero']},
		method: "POST",
		dataType: "json",
		success: function(data){
			var vetGenero = [];
			vetGenero["genero_id"] = data;
			vetGenero["nome"] = vetor["genero"];
			adicionaCombo("genero_id",vetGenero);
			$("#addGenero").modal("hide");
		},error: function(){
			alert("Erro ao adicionar gênero por este form. Contate o desenvolvedor");
		}
	})
}
/*adiciona uma editora no banco de dados através do formulário de livros*/
function adicionaEditoraBanco(vetor){
	$.ajax({
		url: "adicionaEditora",
		data: {"editora":vetor['editora']},
		method: "POST",
		dataType: "json",
		success: function(data){
			var vetEditora = [];
			vetEditora["editora_id"] = data;
			vetEditora["nome"] = vetor["editora"];
			adicionaCombo("editora_id",vetEditora);
			$("#addEditora").modal("hide");
		},error: function(){
			alert("Erro ao adicionar editora por este form. Contate o desenvolvedor");
		}
	})
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
	$("#adiciona_autor").on("click",function(event){
		var campos = [];
		campos['nome'] = $("#nome").val();
		campos['dataNasc'] = $("#dataNasc").val();
		campos['biografia'] = $("#biografia").val();
		adicionaAutorBanco(campos);
	});
	$("#adiciona_genero").on("click",function(event){
		var campos = [];
		campos['genero'] = $("#genero").val();
		adicionaGeneroBanco(campos);
	});
	$("#adiciona_editora").on("click",function(event){
		var campos = [];
		campos["editora"] = $("#editora").val();
		adicionaEditoraBanco(campos);
	});
});	