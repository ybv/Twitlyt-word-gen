<html>

<meta charset="utf-8">
    <title>Twitlytdb</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="css/mobile-device.css" />
   
    <style type="text/css">
      body {
      	background-color: #fff;
      
        padding-top: 60px;
        vertical-align: center;
        padding-bottom: -10px;
    

      }
      
      .hero-unit {
    	
        background-color: #fff;
 
        vertical-align: center;
       
        text-align: center;
            font-family: HelveticaNeue-Light;
      	font-size: 26px;
    }

    .btn {
    
   -webkit-border-color: #eee;
   -moz-border-radius: 20px;
  	border-radius: 20px;
  	 margin-top: 40px;
  	font-size: 20px;
  	font-family: HelveticaNeue-UltraLight;
   	color: #000;
    background: #fff;

    border-color: #000;
     text-align: center;
	}

	
	.form-horizontal{
		text-align: center;
		margin-right: 200px;
        font-family: HelveticaNeue-UltraLight;
        
	}
	.control-group {
		text-align: center;
	}
	.list{
			
		 margin-left: 400px;
        margin-right: 400px;
	}
	
	
    

    </style>

    <body>

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

global $index;
$resource = mysql_query("SELECT COUNT(Actual_word) FROM Word_mappings");
$count = mysql_result($resource,0);
//getting the number of rows

$index = mt_rand(0,500); 
//random number 
echo $index;

$fp = fopen('index.txt', 'w');

$sql = "SELECT Actual_word
        FROM Word_mappings
        WHERE id= '$index' ";

$retval = mysql_query( $sql, $link );

while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
	echo '<div class="hero-unit">';
    echo "Actual word : {$row['Actual_word']}  <br> ";
    echo '</div>';
    fwrite($fp, $row['Actual_word']);

} 

echo '<html><body><form action="insertandredir.php" class= "form-horizontal" method="post"><div class="control-group"> <div class="controls"> <div class="input-prepend"> <input type="text" class="input-xxlarge" name="shortword" placeholder="Type in here a meaningful short form of word diplayed above"><br> <button type="submit" class="btn" >Generate new word</button></div></div></div></form></body></html>';
mysql_close($link);
echo '<div class ="list" >Directions:<ul><li>Type in the short form of the generated word in the text field and click "Generate new word".</li><li>Eg: b4 for before ; 2 for two </li><li>Click "Generate new word" without any input for blank words and words which cannot be shortened meaningfully.  </li></ul> </div>';
fclose($fp);







?>