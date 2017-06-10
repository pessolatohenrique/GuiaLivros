/*função utilizada na index.php, mostrando ou escondendo gêneros de acordo com click do usuário*/
function mostraEscondeMenu(seletor){

}
function setAutoComplete(campo_id,vetor){
	console.log(vetor);
	$("#"+campo_id).autocomplete({
		source: vetor
	});
}
/*lista todos os autores cadastrados, fazendo requisição ao servidor*/
function listaAutores(){
	var endereco = "listaJSON";
	$.ajax({
		url: endereco,
		method: "POST",
		dataType: "json",
		success: function(data){
			var vetNomes = [];
			$.each(data,function(indice,valor){
				vetNomes.push(valor.nome);
			});
			setAutoComplete("nome",vetNomes);
		},
		error: function(){
			alert("Erro ao buscar JSON. Contate o desenvolvedor, pedindo a ele para verificar URL");
		}
	})
}
/*lista todos os livros cadastrados, fazendo requisição ao servidor*/
function listaLivros(titulo){
	var endereco = "livrosJSON";
	if($(".carousel-inner").length){
		endereco = "livro/livrosJSON";
	}
	$.ajax({
		url: endereco,
		method: "POST",
		dataType: "json",
		success: function(data){
			var vetNomes = [];
			$.each(data,function(indice,valor){
				vetNomes.push(valor.titulo);
			});
			setAutoComplete("titulo",vetNomes);
		},error:function(){
			// alert("Erro ao buscar JSON. Contate o desenvolvedor, pedindo a ele para verificar URL");
		}
	});
}
$(document).ready(function(){
	$(".cmbDinamico").select2();
	var titulo = $(".container h1").text();
	if(titulo.toLowerCase() == "pesquisa de autores"){
		listaAutores();
	}else{
		listaLivros(titulo);
	}
	$("#dataNasc").mask("00/00/0000");
	$("#data-inicio").mask("00/00/0000");
	$("#data-fim").mask("00/00/0000");
	$("#form-usuario a").on("click",function(event){
		event.preventDefault();
		document.getElementById("form-usuario").submit();
	});
	$(".mostrarMais").on("click",function(event){
		if($(this).hasClass("mostrarMais")){
			$(".list-group-item:nth-child(n+10)").css("display","block");
			$(".list-group-item:last-child").removeClass("mostrarMais");
			$(".list-group-item:last-child").text("Esconder");
		}else{
			$(".list-group-item:nth-child(n+11)").css("display","none");
			$(".list-group-item:last-child").addClass("mostrarMais");
			$(".list-group-item:last-child").css("display","block");
			$(".list-group-item:last-child").text("Mostrar Mais");
		}
	});

});