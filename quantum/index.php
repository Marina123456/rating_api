<?php
require ("../_utils/index.php");

$q=mysqli_query($Link,'SELECT id, Name FROM BAA_Quantum');
while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
echo json_encode($qq);

?>