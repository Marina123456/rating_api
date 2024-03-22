<?php
require ("../_utils/index.php");

if ($_GET["id_group"]) 
{
    $q=mysqli_query($Link,'SELECT BAA_MemberGroup.id as id_member, 
    BAA_MemberGroup.id_group, BAA_MemberGroup.id_student, 
    BAA_INdivid_Auto.id, BAA_INdivid_Auto.Surname, BAA_INdivid_Auto.Name, 
    BAA_INdivid_Auto.Patronymic, BAA_INdivid_Auto.BirthDate, BAA_INdivid_Auto.idFromNavigator, 
    BAA_INdivid_Auto.Rating  FROM BAA_MemberGroup, BAA_INdivid_Auto 
    WHERE   id_student = BAA_INdivid_Auto.id AND id_group='.$_GET["id_group"].' ORDER BY Rating DESC');

} else {
    $q=mysqli_query($Link,'SELECT BAA_MemberGroup.id as id_member, 
    BAA_MemberGroup.id_group, BAA_MemberGroup.id_student, 
    BAA_INdivid_Auto.id, BAA_INdivid_Auto.Surname, BAA_INdivid_Auto.Name, 
    BAA_INdivid_Auto.Patronymic, BAA_INdivid_Auto.BirthDate, BAA_INdivid_Auto.idFromNavigator, 
    BAA_INdivid_Auto.Rating  FROM BAA_MemberGroup, BAA_INdivid_Auto 
    WHERE   id_student = BAA_INdivid_Auto.id ORDER BY Rating DESC');
}



while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}

echo json_encode($qq);
