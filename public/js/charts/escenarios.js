const chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Escenarios más activos'
    },
    xAxis: {
        categories: [],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Reservas atendidas'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    series: []
});

function fetchData(){
    // Fetch API
    fetch('/charts/escenarios/column/data')
        .then(function(response) {
            return response.json();
        })
        .then(function(myJson) {
            console.log(myJson);
        });
}