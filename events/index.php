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


$Link=mysqli_connect('u512639.mysql.masterhost.ru','u512639','MiEdYIn.3uM','u512639');
if(!$Link)die('Нет подключения к БД!');
mysqli_query($Link,'SET NAMES utf8');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  
    $q=mysqli_query($Link,'SELECT BAA_Event.id, BAA_Event.Name, BAA_Level.Name as Level, BAA_Type.Name as Type, BAA_Status.Name as Status, date_from, date_to FROM BAA_Event, BAA_Type, BAA_Status, BAA_Level WhERE BAA_Event.id_level=BAA_Level.id AND BAA_Event.id_type=BAA_Type.id AND BAA_Event.id_status=BAA_Status.id  ORDER BY date_to DESC ');
    while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
    echo json_encode($qq);
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST")  {
    
    $POST_NEW = json_decode(file_get_contents('php://input'), true);
    $previos = ($POST_NEW['id_previousEvent']=='') ? 'NULL': $POST_NEW['id_previousEvent'];
    $sql = "INSERT INTO BAA_Event (Name,id_type,id_level,id_status, id_previousEvent, date_from, date_to) VALUES ('".$POST_NEW['eventName']."', ".$POST_NEW['id_type'].",".$POST_NEW['id_level'].",".$POST_NEW['id_status'].",".$previos.",'".$POST_NEW['date_from']."','".$POST_NEW['date_to']."')";
    echo $sql;
    if (mysqli_query($Link, $sql))
        echo "OK";
    
}

if ($_SERVER["REQUEST_METHOD"] == "PUT")  getRealPUT();
if ($_SERVER["REQUEST_METHOD"] == "DELETE")  getRealDELETE();

function getRealPOST() {  return getRealInput('POST'); }

function getRealPUT() { return getRealInput('PUT'); }
function getRealDELETE() { return getRealInput('DELETE'); }

?>