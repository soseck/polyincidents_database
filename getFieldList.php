<?php

 require "connexion.php";

mysqli_set_charset($connexion, 'utf8'); 

$field = $_POST["field"];

$mysql_query = "SELECT value from $field";

$result = mysqli_query($connexion, $mysql_query);
$rows = array();

if(mysqli_num_rows($result) > 0){
	while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    print json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

}else{
	echo "fail";
 }

$connexion->close();

?>
