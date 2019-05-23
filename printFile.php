
<?php
echo "<html>";
$fileName = "navs.txt";
$handle = @fopen($fileName, "r");
if ($handle) {
	
	echo "test - File is opened<br>";
	$fileSize = filesize($fileName);
	echo $fileSize;
	$text = fread($handle,$fileSize);
	addTodaysNavToDB($text);
    while (($buffer = fgets($handle, 4096)) !== false) {
        echo ($buffer);
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
		echo "\n reached end of file \n";
    }
    fclose($handle);
}
else{
echo "unable to read the file";
}
echo "</html>";


function addTodaysNavToDB($navPrices)
{
	$counter=0;
	//split the entire text by newline
	$navRows = explode("\n", $navPrices);
	//split the row into fields by ';' if present
	foreach ($navRows as $navRow) 
	{
		if (strstr($navRow, ";")!==FALSE) 
		{
			$navFields = explode(";",$navRow);
			if (is_numeric($navFields[0])) 
			{
				// $nav = new NAV();
				$schemeid = utf8_encode(mysql_real_escape_string($navFields[0]));
				$navprice = is_numeric(utf8_encode(mysql_real_escape_string($navFields[4]))) ? utf8_encode(mysql_real_escape_string($navFields[4])) : 0;
				$repurchaseprice = is_numeric(utf8_encode(mysql_real_escape_string($navFields[4]))) ? utf8_encode(mysql_real_escape_string($navFields[4])) : 0;
				$saleprice = is_numeric(utf8_encode(mysql_real_escape_string($navFields[4]))) ? utf8_encode(mysql_real_escape_string($navFields[4])) : 0;
				$navdate = $navFields[7];
				echo $schemeid; echo "---";echo $navprice; echo "---"; echo $repurchaseprice;echo "<br/>";
				/* $thisLine =  $schemeid+"---"+$navprice+"---"+$repurchaseprice+"<br>";
				echo $thisLine; echo "break"; */
				$counter++;
				// $counter += $nav->setNav($schemeid,$navprice,$repurchaseprice,$saleprice,$navdate);
			}
		}
		
	}
	echo $counter;
	echo "<br>";
}
?>