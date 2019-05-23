<?php
  
  $fileName = "axis.txt";
$handle = @fopen($fileName, "r");
if ($handle) {
	
	echo "test - File is opened<br>";
	$fileSize = filesize($fileName);
	echo $fileSize;
	$text = fread($handle,$fileSize);
	addTodaysNavToDB($text);
    fclose($handle);
}
else{
echo "unable to read the file";
}
echo "</html>";


function addTodaysNavToDB($navPrices)
{
	
// Create connection
$con=mysqli_connect("localhost:3306","root","","fundswatch");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else {
  echo "connected successfully";
  }
	$counter=0;
	//split the entire text by newline
	$navRows = explode("\n", $navPrices);
	//split the row into fields by ';' if present
	
	$currentSchemeId = 0;
	$tableName = "new";
	foreach ($navRows as $navRow) 
	{
		if (strstr($navRow, ";")!==FALSE) 
		{
			$navFields = explode(";",$navRow);
			if (is_numeric($navFields[0])) 
			{
				// $nav = new NAV();
				/* $schemeid = utf8_encode(mysql_real_escape_string($navFields[0]));
				$navprice = is_numeric(utf8_encode(mysql_real_escape_string($navFields[4]))) ? utf8_encode(mysql_real_escape_string($navFields[4])) : 0;
				$repurchaseprice = is_numeric(utf8_encode(mysql_real_escape_string($navFields[4]))) ? utf8_encode(mysql_real_escape_string($navFields[4])) : 0;
				$saleprice = is_numeric(utf8_encode(mysql_real_escape_string($navFields[4]))) ? utf8_encode(mysql_real_escape_string($navFields[4])) : 0;
				$navdate = $navFields[7];
				echo $schemeid; echo "---";echo $navprice; echo "---"; echo $repurchaseprice;echo "<br/>";
				$counter++; */
				// $counter += $nav->setNav($schemeid,$navprice,$repurchaseprice,$saleprice,$navdate);
				//Adding to schemelist table if thrs a new scheme id
				if ($navFields[0]!==$currentSchemeId)
				{					
					echo $currentSchemeId;echo " : ";echo $navFields[0];echo "  -  ";echo $navFields[1];echo "<br/>";
					$currentSchemeId = $navFields[0];
					$schemeName = $navFields[1];
					
					$sql="INSERT INTO schemelist (schemeCode, schemeName) VALUES('$navFields[0]','$navFields[1]')";

					if (!mysqli_query($con,$sql))
					{
					die('Error: ' . mysqli_error($con));
					}
					echo "1 record added";
					// Create table
					$tableName = $currentSchemeId . "_";
					$sql="CREATE TABLE $tableName (date CHAR(30),price FLOAT)";
					// Execute query
					if (mysqli_query($con,$sql))
					{
						echo "$currentSchemeId";echo " table created";
					}
					else
					{
						echo "Error creating table: " . mysqli_error($con);
					}
					
				}
				$sql="INSERT INTO $tableName (date, price) VALUES ('$navFields[5]','$navFields[2]')";
				if (mysqli_query($con,$sql))
				{
					echo "$currentSchemeId";echo " table created";
				}
				else
				{
					echo "Error: " . mysqli_error($con);
				}
			} 
		}
		
	}
	mysqli_close($con);
	echo "<br>";
}
    
?>