const chart = Highcharts.chart("container", {
    chart: {
        type: "column"
    },
    title: {
        text: "Medicos mas activos por mes"
    },
    subtitle: {
        text: "Source: WorldClimate.com"
    },
    xAxis: {
        categories: [],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: "citas atendidas"
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat:
            '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: "</table>",
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: []
});

let $start, $end;

function fetchData() {
    const startDate = $start.val();
    const endDate = $end.val();
    const url = `/charts/doctors/column/data?start=${startDate}&end=${endDate}`;
    fetch(url)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            // console.log(myJson);
            chart.xAxis[0].setCategories(data.categories);
            if (chart.series.length > 0) {
                chart.series[1].remove();
                chart.series[0].remove();
            }
            chart.addSeries(data.series[0]);
            chart.addSeries(data.series[1]);
        });
}

$(function() {
    $start = $("#startDate");
    $end = $("#endDate");

    fetchData();

    $start.change(fetchData);
    $end.change(fetchData);
});
