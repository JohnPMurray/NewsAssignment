<?php

date_default_timezone_set('America/New_York');
ini_set('display_errors', 1);
error_reporting(~0);
session_start();
//get the parameters from URL
$username=$_SESSION['username'];
$newFavorite=array("title"=>$_GET['title'],
                   "desc"=>$_GET['desc'],
                   "link"=>$_GET['link'],
                   "pub_date"=>$_GET['date']);
$json=file_get_contents("./favorites.json");
$json_data= json_decode($json,true);
for ($i = 0; $i<sizeof($json_data); $i++){
    if ($json_data[$i]['username'] == $username){
        $json_data[$i]['favorites'][] = $newFavorite;
        break;
    }
}
echo(json_encode($json_data));
$my_file = 'users.json';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
fwrite($handle, json_encode($json_data));
fclose($handle);
?>