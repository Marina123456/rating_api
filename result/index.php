<?php
require ("../_utils/index.php");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $q=mysqli_query($Link,'SELECT  BAA_Result.id, BAA_Result.Name FROM BAA_Result');
    while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
    echo json_encode($qq);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $POST_NEW = json_decode(file_get_contents('php://input'), true);
    if (!isset($POST_NEW["id_event"]))
    {
        //$POST_NEW2 = file_get_contents('php://input');
        //print_r($POST_NEW2);
        print_r($_FILES);
        //$POST_NEW2 = file_get_contents('php://input');
        //$name_file = "doc".$POST_NEW['id_event']."_".$POST_NEW['id_team']."_".$POST_NEW['id_result'].".jpg";
       // if (isset($POST_NEW2)) {
            $name= $_FILES['pathToDocumentNew']['name'];
            $path = '../_uploads/';
            $file_tmp = $_FILES['pathToDocumentNew']['tmp_name'];
            //echo  $_FILES['pathToDocumentNew']['tmp_name'][0];
            $file = $path . $name;
            if (move_uploaded_file($file_tmp, $file)) 
            {
                echo $path;
            }
            //file_put_contents( $path, $POST_NEW2);
    //}
    } else{
    
    $sgl_id_score = "SELECT BAA_Scores.id as id_score FROM BAA_Event, BAA_Scores WHERE BAA_Scores.id_level=BAA_Event.id_level and BAA_Event.id=".$POST_NEW["id_event"]." and BAA_Scores.id_result=".$POST_NEW['id_result'];
    $query_score=mysqli_query($Link, $sgl_id_score);
    while ($qq[]=mysqli_fetch_array($query_score,MYSQLI_ASSOC)){}
    $id_score=$qq[0]["id_score"];
    $sql = "INSERT INTO BAA_ResultTeam ( id_event, id_team, id_score, pathToDocument) VALUES (". $POST_NEW["id_event"].",".$POST_NEW["id_team"].",".$id_score.",'".$POST_NEW["pathToDocument"]."')";
    echo $sql;
    if (mysqli_query($Link, $sql))
    {
        echo "OK";
    }
}
}
?>