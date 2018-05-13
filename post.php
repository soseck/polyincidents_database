<?php

 require "connexion.php";

 $user_name = "Sokhoe";
 //$_POST["username"];
 $user_password = "mdp";
 //$_POST["password"];
 $surname = "Sokhna";
 $name = "Seck";

$sql = "INSERT INTO user_table (surname, name, username, password)
VALUES ('$surname', '$name', '$user_name', '$user_password')";

if ($connexion->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connexion->error;
}

$connexion->close();

?>
