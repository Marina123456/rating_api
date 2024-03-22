<?php
require ("../_utils/index.php");

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