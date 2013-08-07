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
	//echo 'Connected successfully<br />';
}
$db_selected = mysql_select_db($db, $link);
//connections and selection end here



$sql = "SELECT *
        FROM Word_mappings
        ";

$retval = mysql_query( $sql, $link );

while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
	echo "Id :{$row['id']}, ";
    echo "Actual word :{$row['Actual_word']}, ";
    echo "Shorthand word :{$row['Shorthand_Word']},";
    echo "frequency : {$row['freq_count']} <br>";
} 


mysql_close($link);








?>