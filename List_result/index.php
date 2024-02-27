<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, OPTIONS');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: x-requested-with, Content-Type, origin, authorization, accept, x-access-token');
// Функция для исправления того, что PHP путает ввод, содержащий точки и т. д.

// `$source` может быть либо 'POST', либо 'GET'
//http://192.168.0.26/IT_10_старое/Batmanov/List_kvant/api/teacher/liststudent/index.php?id_group=%271%27
$Link=mysqli_connect('u512639.mysql.masterhost.ru','u512639','MiEdYIn.3uM','u512639');
if(!$Link)die('Нет подключения к БД!');
@mysqli_query($Link,'SET NAMES utf8');
if(!$_GET["id_student"] && !$_GET["id_teacher"])die('Нет параметра!');
if ($_GET["id_student"])
{
    $q=mysqli_query($Link,'SELECT BAA_Event.id, BAA_Event.Name as EVENT, 
    BAA_Result.Name as result, BAA_Level.Name as Level, BAA_Type.Name as Type, 
    BAA_Status.Name as Status, BAA_ResultTeam.pathToDocument, BAA_Scores.Score
    FROM BAA_Event, BAA_Result, BAA_Level, BAA_Type, BAA_Status, BAA_INdivid_Auto, BAA_ResultTeam, BAA_Team, 
    BAA_MemberTeam,  BAA_Scores, BAA_MemberGroup
    WHERE BAA_Event.id_level=BAA_Level.id 
    AND BAA_Event.id_type=BAA_Type.id 
    AND BAA_Event.id_status=BAA_Status.id 
    AND BAA_MemberGroup.id=BAA_MemberTeam.id_MemberGroup 
    and BAA_MemberGroup.id_student=BAA_INdivid_Auto.id 
    and BAA_Team.id=BAA_MemberTeam.id_Team 
    and BAA_ResultTeam.id_team=BAA_Team.id  
    and BAA_ResultTeam.id_score=BAA_Scores.id
    and BAA_ResultTeam.id_event = BAA_Event.id
    and BAA_Result.id = BAA_Scores.id_result
    AND BAA_INdivid_Auto.id='.$_GET["id_student"]);
    while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
    echo json_encode($qq);
}
if ($_GET["id_teacher"]) 
{
    $q=mysqli_query($Link,'SELECT BAA_Event.id, BAA_Event.Name as EVENT, 
    BAA_Result.Name as result, 
    BAA_Level.Name as Level, 
    BAA_Type.Name as Type, 
    BAA_Status.Name as Status, 
    BAA_ResultTeam.pathToDocument, 
    BAA_Scores.Score,
    BAA_Team.id as id_team, 
    BAA_Team.Name as name_team 
    FROM BAA_Event, BAA_Result, BAA_Level, BAA_Type, BAA_Status, 
    BAA_INdivid_Auto, BAA_ResultTeam, BAA_Team, BAA_Scores, BAA_TeacherManager 
    WHERE BAA_Event.id_level=BAA_Level.id AND BAA_Event.id_type=BAA_Type.id 
    AND BAA_Event.id_status=BAA_Status.id and BAA_TeacherManager.id_teacher = BAA_INdivid_Auto.id 
    and BAA_TeacherManager.id_team = BAA_Team.id and BAA_ResultTeam.id_team=BAA_Team.id 
    and BAA_ResultTeam.id_score=BAA_Scores.id and BAA_ResultTeam.id_event = BAA_Event.id 
    and BAA_Result.id = BAA_Scores.id_result AND BAA_INdivid_Auto.id='.$_GET["id_teacher"]);
    while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
    echo json_encode($qq);
}
?>