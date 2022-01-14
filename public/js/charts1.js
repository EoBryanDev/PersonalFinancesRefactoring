
google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Ganhos', 'Despesas'],
          ['Ganhos x Despesas', 5000, 500],
          
        ]);

        var options = {
          chart: {
            subtitle: 'Despesas ',
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          height: 300,
          colors: ['#2F4F4F', '#FFD700']
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

