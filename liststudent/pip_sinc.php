<meta charset=utf-8>

<?php
//$_GET["gr_input"]="gr_7.csv"
$str_f=file_get_contents($_GET["gr_input"]);
echo $str_f;
$str_f_str=explode(chr(13),$str_f);
echo "<pre>";print_r($str_f_str);echo "</pre>";
for($i=1;$i<count($str_f_str);$i++)
	{echo $i;
	 $str_f_pip=explode(";",$str_f_str[$i]);
	 echo "<pre>";print_r($str_f_pip);echo "</pre>";
	 echo "<p>".$str_f_pip[2]." ".$str_f_pip[3]." ".$str_f_pip[4]."</p>";
	}
$Link=mysqli_connect('localhost','itkv','ITkv2020','IT_db');
if(!$Link)die('Нет подключения к БД!');
@mysqli_query($Link,'SET NAMES utf8');
if(!$_GET["id_group"])die('Нет параметра!');

$q=mysqli_query($Link,'SELECT BAA_MemberGroup.id, 
BAA_MemberGroup.id_group, BAA_MemberGroup.id_student, 
BAA_INdivid_Auto.id, BAA_INdivid_Auto.Surname, BAA_INdivid_Auto.Name, 
BAA_INdivid_Auto.Patronymic, BAA_INdivid_Auto.BirthDate, BAA_INdivid_Auto.idFromNavigator, 
BAA_INdivid_Auto.Rating  FROM BAA_MemberGroup, BAA_INdivid_Auto 
WHERE   id_student = BAA_INdivid_Auto.id AND BAA_INdivid_Auto.Is_Teacher =0 AND id_group='.$_GET["id_group"]);

while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
//echo json_encode($qq);
echo "<pre>";print_r($qq);echo "</pre>";

?>