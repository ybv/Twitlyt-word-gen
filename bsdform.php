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

$resource = mysql_query("SELECT COUNT(Actual_word) FROM Word_mappings");
$count = mysql_result($resource,0);

echo $count ;


?>