<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          <?php
		  $con=mysqli_connect("localhost:3306","root","","fundswatch");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql = "SELECT * FROM 117448_";
$result = mysqli_query($con,$sql);
$row  = mysqli_fetch_array($result,MYSQLI_NUM);
echo "['date', 'price'],\n";
while($row = mysqli_fetch_array($result))
  {
  echo "['".trim($row[0])."', ".$row[1]."],\n";
//  echo "<br/>";
  }
  mysqli_close($con);	
        ?>]);

        var options = {
          title: 'Company Performance',
		  curveType: 'function',
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>