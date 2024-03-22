<?
require ("../_utils/index.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  
    $q=mysqli_query($Link,'SELECT BAA_Event.id, BAA_Event.Name, BAA_Level.Name as Level, BAA_Type.Name as Type, BAA_Status.Name as Status, date_from, date_to FROM BAA_Event, BAA_Type, BAA_Status, BAA_Level WhERE BAA_Event.id_level=BAA_Level.id AND BAA_Event.id_type=BAA_Type.id AND BAA_Event.id_status=BAA_Status.id  ORDER BY date_to DESC ');
    while ($qq[]=mysqli_fetch_array($q,MYSQLI_ASSOC)){}
    echo json_encode($qq);
    
}
?>