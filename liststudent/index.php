<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, OPTIONS');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: x-requested-with, Content-Type, origin, authorization, accept, x-access-token');
// Функция для исправления того, что PHP путает ввод, содержащий точки и т. д.

// `$source` может быть либо 'POST', либо 'GET'

function getRealInput($source) {

    $pairs = explode("&",  file_get_contents("php://input") );

    $vars = array();

    foreach ($pairs as $pair) {

        $nv = explode("=", $pair);

        $name = urldecode($nv[0]);

        $value = urldecode($nv[1]);

        $vars[$name] = $value;

    }

    return $vars;

}





function getRealPOST() { return getRealInput('POST'); }

function getRealPUT() { return getRealInput('PUT'); }
function getRealDELETE() { return getRealInput('DELETE'); }

//http://192.168.0.26/IT_10_старое/Batmanov/List_kvant/api/teacher/liststudent/index.php?id_group=%271%27
$Link=mysqli_connect('u512639.mysql.masterhost.ru','u512639','MiEdYIn.3uM','u512639');
if(!$Link)die('Нет подключения к БД!');
@mysqli_query($Link,'SET NAMES utf8');
if(!$_GET["id_group"])die('Нет параметра!');

$q=mysqli_query($Link,'SELECT BAA_MemberGroup.id as id_member, 
BAA_MemberGroup.id_group, BAA_MemberGroup.id_student, 
BAA_INdivid_Auto.id, BAA_INdivid_Auto.Surname, BAA_INdivid_Auto.Name, 
BAA_INdivid_Auto.Patronymic, BAA_INdivid_Auto.BirthDate, BAA_INdivid_Auto.idFromNavigator, 
BAA_INdivid_Auto.Rating  FROM BAA_MemberGroup, BAA_INdivid_Auto 
WHERE   id_student = BAA_INdivid_Auto.id AND BAA_INdivid_Auto.Is_Teacher =0 AND id_group='.$_GET["id_group"]);

while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}

echo json_encode($qq);
