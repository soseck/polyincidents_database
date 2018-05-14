<?php

 require "connexion.php";

 $username = $_POST["username"];

mysqli_set_charset($connexion, 'utf8'); 

//In order to get incidents declared by user only
/*
 $username = "sn713708";

$sql1 = "SELECT * from user_table where username like '$username'";
$result1 = mysqli_query($connexion, $sql2);

if(mysqli_num_rows($result1) > 0){
	while($row = $result1->fetch_assoc()){
        $user_id = $row["id_user"];
   	}

} else {
	echo "Error: " . $sql2 . "<br>" . $connexion->error;
 }
 */

$mysql_query = "SELECT ut.surname, ut.name, inc.title, inc.content, inc.location, inc.date, t.tag, imp.importance, urg.urgence from incident as inc,
  default_tag as t, importance as imp, urgence as urg, user_table as ut WHERE
      ut.username like '$username' and
    t.id_tag = inc.id_tag and urg.id_urgence = inc.id_urgence and imp.id_importance = inc.id_importance and inc.id_incident
IN (SELECT ia.id_incident from incident_author as ia where ia.id_user IN (SELECT us.id_user from user_table as us
    WHERE us.username like '$username'));";

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
