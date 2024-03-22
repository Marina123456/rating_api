<?php
require ("../_utils/index.php");

$q=mysqli_query($Link,'SELECT  BAA_Type.id, BAA_Type.Name FROM BAA_Type');
while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
echo json_encode($qq);
?>