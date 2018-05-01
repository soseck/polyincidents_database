<?php
$host="den1.mysql4.gear.host";
$port=3306;
$socket="";
$user="polyincidents";
$password="Cf10~_e4Lqtw";
$dbname="polyincidents";

$connexion = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
?>

