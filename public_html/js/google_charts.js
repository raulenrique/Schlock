
// AJAX
$.ajax({

  url: 'api/tags.php',

  success: function( dataFromServer ){

    console.log(dataFromServer);

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();

      // Declare columns
      data.addColumn('string', 'TagID');
      data.addColumn('number', 'Count');



      for (var i = 0; i < dataFromServer.length; i++) {
        data.addRows([
                [dataFromServer[i].tag, parseInt(dataFromServer[i].tagCount) ]
        ]);
      };

      console.log(data);
      var options = {
        title: 'Film Tags'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }


  },
  error: function() {
    alert('Something went wrong');
  }
});