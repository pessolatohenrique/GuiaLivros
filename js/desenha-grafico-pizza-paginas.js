google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
    /*configurações de eixo e título do gráfico*/
    var eixoX = $(".tabela-grafico tr th:nth-child(3)").text();
    var eixoY = $(".tabela-grafico tr th:first-child").text();
    var coluna_titulo = $(".tabela-grafico tr th:first-child").text();
    var titulo = "Total de páginas por " + coluna_titulo;
    /*fim das configurações de eixo e título do gráfico*/
    var tabela = $(".tabela-grafico");
    var tamanho_grafico = parseInt(tabela.find("tr").length);
    var data = new google.visualization.DataTable();
    data.addColumn('string',eixoY);
    data.addColumn('number',eixoX);
    data.addRows(tamanho_grafico);
    tabela.find("tbody tr:not(tr:last-child)").each(function(indice){
        var indiceAtualizado = parseInt(indice) + 1;
        var descricao = $(".tabela-grafico tr:nth-child("+indiceAtualizado+")").find("td:first-child").text();
        var quantidade = $(".tabela-grafico tr:nth-child("+indiceAtualizado+")").find("td:nth-child(2)").text();
        var paginas = $(".tabela-grafico tr:nth-child("+indiceAtualizado+")").find("td:nth-child(3)").text();
        data.setValue(indice,0, descricao);
        data.setValue(indice,1, paginas);        
    });
      var options = {
        title: titulo,
        width: 550,
        height: 350
      };
  if($("#grafico_pizza").length){
    var chart = new google.visualization.PieChart(document.getElementById('grafico-pizza-paginas'));
    chart.draw(data, options);
  }

}