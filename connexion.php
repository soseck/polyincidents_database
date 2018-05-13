<?php
$host="den1.mysql5.gear.host";
$user="polyincidentsdb";
$password="polytech*";
$dbname="polyincidentsdb";

$connexion = mysqli_connect($host, $user, $password, $dbname)
	or die ('Could not connect to the database server' . mysqli_connect_error());
?>

