<?php
connectToDb();
newUser("Nedim");

function connectToDb(){
$user="wifind";
$password="wifi0102";
$database="wifind"; //Database ad�
mysql_connect("localhost",$user,$password);
@mysql_select_db($database) or die( "Unable to select database");
}
function getUpdates(){
    $query="SELECT * FROM Status JOIN User WHERE Status.user_id=User.id ORDER BY status_id DESC";
    $result=mysql_query($query);
    $arr=array();
    while ($row = mysql_fetch_assoc($result)) {
	array_push($arr,$row);
    }
    echo json_encode($arr);
}
function addStatus($userId,$message,$accessPointMAC){
    $apQuery="SELECT id FROM AccessPoint WHERE MAC='".$accessPointMAC."'";
    $apResult=mysql_query($apQuery);
    $apResult = mysql_fetch_assoc($apResult);
    $apId=$apResult['id'];
    
    $insertQuery="INSERT INTO Status(message,user_id,ap_id) VALUES ('".$message."',".$userId.",".$apId.")";
    mysql_query($insertQuery);
}
function newUser($name){
    $insertQ="INSER INTO User(name) VALUES ('".$name."')";
    echo $insertQ;
    mysql_query($insertQ);
    echo mysql_insert_id();
}
function disconnectFromDb(){    
mysql_close();
}

?>