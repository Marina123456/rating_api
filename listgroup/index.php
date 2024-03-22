<?php
require ("../_utils/index.php");

if($_GET["id_teacher"])
{
    $q=mysqli_query($Link,'SELECT BAA_Group.id, Name, id_Teacher, id_quantum, COUNT(BAA_MemberGroup.id) as count_member FROM BAA_Group, BAA_MemberGroup WHERE BAA_MemberGroup.id_group=BAA_Group.id and id_Teacher = '.$_GET["id_teacher"].' group by BAA_MemberGroup.id_group');
    while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
    echo json_encode($qq);
}
if($_GET["id_quantum"])
{
    $q=mysqli_query($Link,'SELECT id, Name, id_Teacher, id_quantum FROM BAA_Group WHERE id_quantum = '.$_GET["id_quantum"]);
    while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
    echo json_encode($qq);
}
if(!$_GET["id_teacher"] && !$_GET["id_quantum"])die('Нет параметра!');


?>