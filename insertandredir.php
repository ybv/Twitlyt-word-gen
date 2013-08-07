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

$index = file_get_contents('index.txt', true);

echo $index . "<br>";

$variable = mysql_real_escape_string($_POST[shortword]);

if($_POST[shortword]===""){

}
else{
$resource = mysql_query("SELECT count(Shorthand_word) FROM Word_mappings WHERE Shorthand_word LIKE '%{$variable}%'");
$count = mysql_result($resource,0);
echo $count;
if($count==0){
	echo $count;
	echo "inserting new shortword";
$sql = " INSERT INTO Word_mappings (Actual_word, Shorthand_word, freq_count) VALUES ('$index', '$variable',1) ";

$result=mysql_query($sql);
}
else {
	echo $count;
	echo "updating existing word's frequency";
	$sql = " UPDATE Word_mappings SET freq_count = freq_count+1  WHERE Actual_word='$index' AND Shorthand_word= '$variable'";
	$result=mysql_query($sql);
}
file_put_contents("index.txt", "");
  

if($result){
echo "Successful";
echo "<BR>";

 


}

  }

 header( 'Location: http://twitlytdb.ap01.aws.af.cm/counter.php' ) ;

?>