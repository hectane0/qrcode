$(document).ready(function () {

    // google.charts.load('current', {'packages':['corechart']});
    google.charts.load('current', {'packages':['annotatedtimeline']});
    google.charts.setOnLoadCallback(drawChart);


    function drawChart()
    {
        var now = new Date();

        var rows = [];
        for (var d = new Date(stats[0].date); d <= now; d.addHours(1) ) {

            var stat = stats.filter(function(obj) {
                return obj.date == d.objectFormat();
            });

            if (stat[0]) {
                rows.push([new Date(stat[0].date), parseInt(stat[0].count)]);
            } else {
                var date = new Date(d);
                rows.push([date, 0]);
            }
        }

        var data = new google.visualization.DataTable();
        data.addColumn('datetime', 'Godzina');
        data.addColumn('number', 'Skany');
        data.addRows(rows);

        var options = {
            'title':'Rozkład w czasie',
            hAxis: {
                format: "yyyy-MM-dd HH:mm"
            },
            'interpolateNulls': true,
            displayAnnotations: true
        };

        var chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    Date.prototype.addHours = function(h) {
        this.setTime(this.getTime() + (h*60*60*1000));
        return this;
    };
    
    Date.prototype.objectFormat = function () {
        return [this.getFullYear(),
                ('0' + (this.getMonth()+1)).slice(-2),
                ('0' + this.getDate()).slice(-2)
            ].join('-')
            +' '+
                [('0' + this.getHours()).slice(-2),
                "00",
                "00"].join(':');
    }
});