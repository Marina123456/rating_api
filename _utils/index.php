<?
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
?>