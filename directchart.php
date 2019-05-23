<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
		
		//------------------------------------------------------------
		 <?php
		  
$con=mysqli_connect("localhost:3306","root","","fundswatch");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$result = mysqli_query($con,"SELECT * FROM '117447_'");

echo "['date', 'price']\n";
while($row = mysqli_fetch_array($result))
  {
  echo "['".$row['date']."', '".$row['price']."'],\n";
//  echo "<br/>";
  }
  mysqli_close($con);	
	
  
?>	
		
		//------------------------------------------------------------
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance'
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