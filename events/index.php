<?php
require ("../_utils/index.php");


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