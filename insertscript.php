<?php

$services_json = json_decode(getenv("VCAP_SERVICES"),true);
$mysql_config = $services_json["mysql-5.1"][0]["credentials"];

$username = $mysql_config["username"];
$password = $mysql_config["password"];
$hostname = $mysql_config["hostname"];
$port = $mysql_config["port"];
$db = $mysql_config["name"];
$link = mysql_connect("$hostname:$port", $username, $password);
if(! $link )
{
  die('Could not connect: ' . mysql_error());
}
else {
	echo 'Connected successfully<br />';
}
$db_selected = mysql_select_db($db, $link);

$myFile = "dump.txt";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
echo (string)$theData;
$stack = explode( ',', $theData ) ;


fclose($fh);
foreach ($stack as $value)
  {
  echo (string)$value . "<br>";
 // $sql="INSERT INTO Word_mappings(Actual_word)VALUES('$value')";
$result=mysql_query($sql);

// if successfully insert data into database, displays message "Successful". 
if($result){
echo "Successful";
echo "<BR>";

}
  }



?>