<?php
require ("../_utils/index.php");

$q=mysqli_query($Link,'SELECT  BAA_Level.id, BAA_Level.Name FROM BAA_Level');
while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
echo json_encode($qq);

?>