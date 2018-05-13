<?php

 require "connexion.php";

 $title = $connexion->real_escape_string($_POST["title"]);
 $content = $connexion->real_escape_string($_POST["content"]);
 $location = $connexion->real_escape_string($_POST["location"]);

 $username = $_POST["username"];

mysqli_set_charset($connexion, 'utf8'); 

$sql = "INSERT INTO incident (title, content, location)
VALUES ('$title', '$content', '$location')";


$last_id = 0;
if ($connexion->query($sql) === TRUE) {
	//Select if of last recorded entry.
	$last_id = $connexion->insert_id;
    
   	//find user_id -- not mandatory if user_id is given as a parameter
    $sql2 = "SELECT * from user_table where username like '$username'";
	$result = mysqli_query($connexion, $sql2);

	if(mysqli_num_rows($result) > 0){
		while($row = $result->fetch_assoc()){
	        $user_id = $row["id_user"];
	        $surname = $row["surname"];
	   	}
	   		// Link incident with its author in table incident_author
			$sql3 = "INSERT INTO incident_author (id_incident, id_user) VALUES ('$last_id','$user_id')";

			if ($connexion->query($sql3) === TRUE) {
			    echo "success"; 
			} else {
			    echo "Error: " . $sql3 . "<br>" . $connexion->error;
			}

    } else {
		echo "Error: " . $sql2 . "<br>" . $connexion->error;
	 }


} else {
    echo "Error: " . $sql . "<br>" . $connexion->error;
}

$connexion->close();

?>
