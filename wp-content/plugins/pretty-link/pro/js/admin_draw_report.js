jQuery(document).ready( function($) {
  $('#sdate').datepicker({ dateFormat: 'yy-mm-dd', defaultDate: -30, minDate: PlpReport.min_date, maxDate: 0 });
  $('#edate').datepicker({ dateFormat: 'yy-mm-dd', minDate: PlpReport.min_date, maxDate: 0 });
  $('.filter_pane').hide();
  $('.filter_toggle').click( function () {
    $('.filter_pane').slideToggle('slow');
  });
});

google.load('visualization', '1', {packages:['corechart']});
google.setOnLoadCallback(drawPlpReport);

function drawPlpReport() {
  //Rotations Chart
  var rotationsChartJsonData = PlpReport.data;
  var rotationsChartData = new google.visualization.DataTable(rotationsChartJsonData);
  var rotationsChart = new google.visualization.ColumnChart(document.getElementById('clicks_chart'));

  var options = {
    title: PlpReport.title,
    height: 300
  };

  rotationsChart.draw(rotationsChartData, options);
}

