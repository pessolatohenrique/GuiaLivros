google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);
function drawBasic() {
    /*configurações de eixo e título do gráfico*/
    var eixoX = $(".tabela-grafico tr th:nth-child(3)").text();
    var eixoY = $(".tabela-grafico tr th:first-child").text();
    var titulo = "Total de páginas por " + eixoY;
    /*fim das configurações de eixo e título do gráfico*/
    var tabela = $(".tabela-grafico");
    var tamanho_grafico = parseInt(tabela.find("tr").length);
    var data = new google.visualization.DataTable();
    data.addColumn('string',eixoY);
    data.addColumn('number',eixoX);
    data.addRows(tamanho_grafico);
    tabela.find("tr:not(tr > th)").each(function(indice){
        var indiceAtualizado = parseInt(indice) + 1;
        var descricao = $(".tabela-grafico tr:nth-child("+indiceAtualizado+")").find("td:first-child").text();
        var quantidade = $(".tabela-grafico tr:nth-child("+indiceAtualizado+")").find("td:nth-child(2)").text();
        var paginas = $(".tabela-grafico tr:nth-child("+indiceAtualizado+")").find("td:nth-child(3)").text();
        data.setValue(indice,0, descricao);
        data.setValue(indice,1, paginas);        
    });
      var options = {
        title: titulo,
        chartArea: {width: '70%'},
        height: 350,
        hAxis: {
          title: eixoX,
          minValue: 0
        },
        vAxis: {
          title: eixoY
        }
      };
      //só executa o desenho do gráfico caso a div existir
    if($("#grafico_barra").length){
        var chart = new google.visualization.BarChart(document.getElementById('grafico_barra'));
        chart.draw(data, options);
    }
}