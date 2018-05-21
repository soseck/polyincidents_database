<?php

 require "connexion.php";

mysqli_set_charset($connexion, 'utf8'); 

$incident_ID = $_POST["incident_ID"];

$mysql_query = "SELECT image.filepath from image where image.id_incident = $incident_ID ";

$result = mysqli_query($connexion, $mysql_query);
$rows = array();

if(mysqli_num_rows($result) > 0){
	while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    print json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

 }else{
 	echo "No Image";
 }

$connexion->close();

?>
