/*calcula o total de acordo com uma tabela fornecida e o número da coluna correspondente*/
function calculaTotal(tabela,coluna){
	var linhas = tabela.find("tr");
	var total = 0;
	var valor = 0;
	var filtro = ":nth-child("+coluna+")";
	$.each(linhas,function(key,val){
		valor = $(val).find(filtro).text();
		total = total + parseInt(valor);
	});
	return total;
}
function novaLinha(quantidade,paginas){
	var tabela = $(".tabela-grafico");
	var linha = $("<tr>").addClass("bg-info").addClass("enfase");
	var colunaAutor = $("<td>").text("Total");
	var colunaQtd = $("<td>").text(quantidade);
	var colunaPaginas = $("<td>").text(paginas);
	linha.append(colunaAutor);
	linha.append(colunaQtd);
	linha.append(colunaPaginas);
	tabela.append(linha);
}
$(document).ready(function(){
	var possuiGrafico = $("table").hasClass("tabela-grafico");
	if(possuiGrafico){
		var tabela = $("table").find("tbody");
		var totalQtd = calculaTotal(tabela,2);
		var totalPaginas = calculaTotal(tabela,3);
		novaLinha(totalQtd,totalPaginas);
	}
});