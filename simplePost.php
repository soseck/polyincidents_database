<?php

 require "connexion.php";

 mysqli_set_charset($connexion, 'utf8'); 

  $username = $_POST["username"];

 $title = $connexion->real_escape_string($_POST["title"]);
 $content = $connexion->real_escape_string($_POST["content"]);
 $location = $connexion->real_escape_string($_POST["location"]);
 $urgence = $_POST["urgence"];
 $importance = $_POST["importance"];
 $tag = $_POST["tag"];

 //Find id for urgence, importance and tag
 $tag_sql = "SELECT id_tag from default_tag where value like '$tag'";
 $urg_sql = "SELECT id_urgence from urgence where value like '$urgence'";
 $imp_sql = "SELECT id_importance from importance where value like '$importance'";

 $result = mysqli_query($connexion, $tag_sql);
	if(mysqli_num_rows($result) > 0){
		while($row = $result->fetch_assoc()){
	        $tag_id = $row["id_tag"];
	   	}
	}
 $result = mysqli_query($connexion, $urg_sql);
	if(mysqli_num_rows($result) > 0){
		while($row = $result->fetch_assoc()){
	        $urg_id = $row["id_urgence"];
	   	}
	}
 $result = mysqli_query($connexion, $imp_sql);
	if(mysqli_num_rows($result) > 0){
		while($row = $result->fetch_assoc()){
	        $imp_id = $row["id_importance"];
	   	}
	}

//Insert Date if given - else we don't (timeStamp by default)
	$date_key = "";
	$date_value = "";

if(isset($_POST["date"])){
	$date_key = ", date";
	$value = $_POST["date"];
	$date_value = ", '$value'";
}

//Make request
$sql = "INSERT INTO incident (title, content, location, id_tag, id_importance, id_urgence " . $date_key . ")
VALUES ('$title', '$content', '$location', '$tag_id', '$imp_id', '$urg_id' " . $date_value . ")";


$last_id = 0;
if ($connexion->query($sql) === TRUE) {
	//Select id of last recorded entry.
	$last_id = $connexion->insert_id;
    
   	//find user_id -- not mandatory if user_id is given as a parameter
    $sql2 = "SELECT * from user_table where username like '$username'";
	$result = mysqli_query($connexion, $sql2);

	if(mysqli_num_rows($result) > 0){
		while($row = $result->fetch_assoc()){
	        $user_id = $row["id_user"];
	   	}
	   		// Link incident with its author in table incident_author
			$sql3 = "INSERT INTO incident_author (id_incident, id_user) VALUES ('$last_id','$user_id')";

			if ($connexion->query($sql3) === TRUE) {
			    echo $last_id; 
			} else {
			    echo "fail";
			}

    } else {
		echo "fail";
	 }


} else {
    echo "fail";
}

$connexion->close();

?>
