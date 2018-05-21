<?php

 require "connexion.php";

mysqli_set_charset($connexion, 'utf8'); 

$mysql_query = "SELECT u.surname, u.name, inc.title, inc.content, inc.location, inc.date, t.value as tag, imp.value as importance, urg.value as urgence from incident as inc, default_tag as t, importance as imp, urgence as urg, user_table as u WHERE inc.id_tag = t.id_tag and inc.id_importance = imp.id_importance and inc.id_urgence = urg.id_urgence 
		and (u.surname, u.name) IN (SELECT us.surname, us.name FROM user_table as us WHERE us.id_user = (SELECT ia.id_user FROM incident_author as ia WHERE ia.id_incident = inc.id_incident)) ORDER BY inc.date desc ";

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
