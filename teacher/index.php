<?php
require ("../_utils/index.php");

$q=mysqli_query($Link,'SELECT id, CONCAT(Surname, " ", Name," ",Patronymic) as FIO  FROM  BAA_INdivid_Auto WHERE Is_Teacher=1');
while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
echo json_encode($qq);
