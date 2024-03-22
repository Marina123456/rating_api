<?php
require ("../_utils/index.php");

$q=mysqli_query($Link,'SELECT  BAA_Status.id, BAA_Status.Name FROM BAA_Status');
while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
echo json_encode($qq);

?>