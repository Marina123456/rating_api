<?php
//http://192.168.0.26/IT_10_старое/Batmanov/List_kvant/api/teacher/liststudent/index.php?id_group=%271%27
$Link=mysqli_connect('localhost','itkv','ITkv2020','IT_db');
if(!$Link)die('Нет подключения к БД!');
@mysqli_query($Link,'SET NAMES utf8');
if(!$_GET["id_student"])die('Нет параметра!');

$q=mysqli_query($Link,'SELECT BAA_Team.Name, BAA_Event.Name, BAA_Event.id_previousEvent, BAA_ResultTeam.pathToDocument, BAA_Scores.Score, BAA_Type.Name as type, BAA_Level.Name as level, BAA_Status.Name as status2,
BAA_Result.id, BAA_Result.Name as result
FROM BAA_MemberGroup, BAA_MemberTeam, BAA_Team, BAA_Event, BAA_ResultTeam, BAA_Scores, BAA_Status, BAA_Type, BAA_Level, BAA_Result
WHERE BAA_MemberGroup.id=BAA_MemberTeam.id_MemberGroup AND BAA_MemberTeam.id_MemberGroup=BAA_Team.id AND BAA_Team.id=BAA_ResultTeam.id_team AND BAA_Scores.id=BAA_ResultTeam.id_score 
AND BAA_Status.id=BAA_Event.id_status AND BAA_Type.id=BAA_Event.id_type AND BAA_Level.id=BAA_Event.id_level AND BAA_Result.id=BAA_Scores.id_result AND id_student='.$_GET["id_student"]);

while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
echo json_encode($qq);

?>