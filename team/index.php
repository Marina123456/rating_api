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
    $q=mysqli_query($Link,'SELECT  BAA_Team.id, BAA_Team.Name FROM BAA_Team');
    $ObjsTeam = array();

    while ($qq=mysqli_fetch_array($q,MYSQLI_ASSOC)){
        $object = new stdClass();
        $object->name = $qq['Name'];
        $object->id = $qq['id'];
    
        $object->teachers=array();
        $q2=mysqli_query($Link,'SELECT BAA_INdivid_Auto.id, CONCAT(BAA_INdivid_Auto.Surname, " ", BAA_INdivid_Auto.Name," ",BAA_INdivid_Auto.Patronymic) as FIO FROM BAA_TeacherManager, BAA_INdivid_Auto Where BAA_TeacherManager.id_teacher=BAA_INdivid_Auto.id AND BAA_TeacherManager.id_team='. $qq['id']);
        while ($qq2=mysqli_fetch_array($q2,MYSQLI_ASSOC)){
            $object2 = new stdClass();
            $object2->fio = $qq2['FIO'];
            $object2->id = $qq2['id'];
            
            $object->teachers[]=$object2;
        }
        $object->students=array();
        $q2=mysqli_query($Link,'SELECT BAA_INdivid_Auto.id, CONCAT(BAA_INdivid_Auto.Surname, " ", BAA_INdivid_Auto.Name," ",BAA_INdivid_Auto.Patronymic) as FIO FROM BAA_MemberTeam, BAA_MemberGroup,BAA_INdivid_Auto WHERE BAA_MemberGroup.id=BAA_MemberTeam.id_MemberGroup AND BAA_MemberGroup.id_student=BAA_INdivid_Auto.id AND BAA_MemberTeam.id_Team='. $qq['id']);
        while ($qq2=mysqli_fetch_array($q2,MYSQLI_ASSOC))
        {
            $object3= new stdClass();
            $object3->fio = $qq2['FIO'];
            $object3->id = $qq2['id'];
            $object->students[]=$object3;
        }
        $ObjsTeam[] = $object;
    }
    echo json_encode($ObjsTeam);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $POST_NEW = json_decode(file_get_contents('php://input'), true);
    print_r($POST_NEW);
    $sql = "INSERT INTO BAA_Team (Name) VALUES ('".$POST_NEW['nameTeam']."')";
    //echo $sql;
    if (mysqli_query($Link, $sql))
        {
            foreach($POST_NEW["studentList"] as $key => $val)
            {
                $sql2 = "INSERT INTO BAA_MemberTeam (id_Team, id_MemberGroup) VALUES ((SELECT MAX(BAA_Team.id) from BAA_Team),".$val['idStudent'].")";
                mysqli_query($Link, $sql2);

            }
            foreach($POST_NEW["teacherList"] as $key => $val)
            {
                $sql3 = "INSERT INTO BAA_TeacherManager (id_team, id_teacher) VALUES ((SELECT MAX(BAA_Team.id) from BAA_Team),".$val['idTeacher'].")";
                mysqli_query($Link, $sql3);
                
            }
            
        
        }
        echo "OK";
}
?>