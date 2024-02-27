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



$Link=mysqli_connect('u512639.mysql.masterhost.ru','u512639','MiEdYIn.3uM','u512639');
if(!$Link)die('Нет подключения к БД!');
mysqli_query($Link,'SET NAMES utf8');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $q=mysqli_query($Link,'SELECT  BAA_Result.id, BAA_Result.Name FROM BAA_Result');
    while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
    echo json_encode($qq);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $POST_NEW = json_decode(file_get_contents('php://input'), true);
    $name_file = "doc".$POST_NEW['id_event']."_".$POST_NEW['id_team']."_".$POST_NEW['id_result'].".jpg";
    $sgl_id_score = "SELECT BAA_Scores.id as id_score FROM BAA_Event, BAA_Scores WHERE BAA_Scores.id_level=BAA_Event.id_level and BAA_Event.id=".$POST_NEW["id_event"]." and BAA_Scores.id_result=".$POST_NEW['id_result'];
    $query_score=mysqli_query($Link, $sgl_id_score);
    while ($qq[]=mysqli_fetch_array($query_score,MYSQLI_ASSOC)){}
    $id_score=$qq[0]["id_score"];
    $sql = "INSERT INTO BAA_ResultTeam ( id_event, id_team, id_score, pathToDocument) VALUES (". $POST_NEW["id_event"].",".$POST_NEW["id_team"].",".$id_score.",'".$name_file."')";
    
    if (mysqli_query($Link, $sql))
    {
        echo "OK";
    }
}
?>