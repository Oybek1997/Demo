<!DOCTYPE html>
<html lang="en-US">
<body>

<h1>Privacy catalog of your Documents</h1>

<div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Documents', 'Privacy'],
            ['Private', {{$private_count}}],
            ['Public',{{$public_count}}],
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {'title':'Privacy of User Documents', 'width':550, 'height':400};

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>

</body>
</html>
