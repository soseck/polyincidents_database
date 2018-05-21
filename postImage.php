<?php

 require "connexion.php";

 mysqli_set_charset($connexion, 'utf8'); 
 
 if(isset($_POST["encoded_string"])){
 	
	$encoded_string = $_POST["encoded_string"];
	$image_name = $_POST["image_name"];
	$id_incident = $_POST["incident_ID"];
	
	$decoded_string = base64_decode($encoded_string);
	
	if (!file_exists('images/'.$id_incident)) {
    mkdir('images/'. $id_incident, 0777, true);
	}

	$path = 'images/'. $id_incident .'/'.$image_name;

	$file = fopen($path, 'wb');
	
	$is_written = fwrite($file, $decoded_string);
	fclose($file);
	
	if($is_written > 0) {
		
		$query = "INSERT INTO image(id_incident,filepath) values('$id_incident','$path');";
				
		if($connexion->query($query) === TRUE){

			//Update incident to image is True
			$update = "UPDATE incident SET image = 1 WHERE id_incident = '$id_incident';";

			if($connexion->query($update) === TRUE){
				echo "success";

			}else{
				echo "Error: " . $query . "<br>" . $connexion->error;
			}

		}else{
			echo "Error: " . $query . "<br>" . $connexion->error;
		}
		
		mysqli_close($connexion);
	}
 }
?>