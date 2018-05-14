<?php

 require "connexion.php";

 $recherche = $_POST["recherche"];

mysqli_set_charset($connexion, 'utf8');

//In order to do research

$mysql_query = SELECT u.surname, u.name, inc.title, inc.content, inc.location, inc.date, t.tag, imp.importance, urg.urgence from incident as inc, default_tag as t, importance as imp, urgence as urg, user_table as u WHERE inc.id_tag = t.id_tag and inc.id_importance = imp.id_importance and inc.id_urgence = urg.id_urgence and (u.surname, u.name) IN
(SELECT us.surname, us.name FROM user_table as us WHERE us.id_user = (SELECT ia.id_user FROM incident_author as ia WHERE ia.id_incident = inc.id_incident)) and
 ( u.surname LIKE '%recherche' || u.name LIKE '%recherche%' || inc.title LIKE '%recherche%' || inc.content LIKE '%recherche%' || inc.location LIKE '%recherche%' || inc.date LIKE '%recherche%' || t.tag LIKE '%recherche%'|| imp.importance LIKE '%recherche%'|| urg.urgence LIKE '%recherche%');

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