$(document).ready(function () {

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);


    function drawChart()
    {
        var rows = [];
        $.each(stats, function () {
            rows.push([new Date(this.date), parseInt(this.count)]);
        });

        var data = new google.visualization.DataTable();
        data.addColumn('datetime', 'Godzina');
        data.addColumn('number', 'Skany');
        data.addRows(rows);

        var options = {
            'title':'Rozkład w czasie',
            'height':300,
            hAxis: {
                format: "yyyy-MM-dd HH:mm"
            },
            'interpolateNulls': true
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }





});