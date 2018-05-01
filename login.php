<?php

 require "connexion.php";

 $user_name = $_POST["username"];
 $user_password = $_POST["password"];

$mysql_query = " select * from user_table where username like '$user_name' and password like '$user_password' ; ";

$result = mysqli_query($connexion, $mysql_query);

if(mysqli_num_rows($result) > 0){
	echo "success";
}else{
	echo "fail";
 }


?>
