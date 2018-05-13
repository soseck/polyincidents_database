<?php

 require "connexion.php";

$username = $_POST["username"];

mysqli_set_charset($connexion, 'utf8'); 

$mysql_query = "SELECT surname, name from user_table where username like '$username' ";

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
