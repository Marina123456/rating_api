<?php


require("../_utils/index.php");

$sql_str = "SELECT * FROM BAA_INdivid_Auto WHERE email=".$_GET["email"]." and password=MD5(".$_GET["password"].")";

$q=mysqli_query($Link,$sql_str);
while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
echo json_encode($qq);
?>