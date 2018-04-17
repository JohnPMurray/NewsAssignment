<?php

date_default_timezone_set('America/New_York');
ini_set('display_errors', 1);
error_reporting(~0);
session_start();
//get the parameters from URL
$username=$_SESSION['username'];
$json=file_get_contents("./users.json");
$json_data= json_decode($json,true);
for ($i = 0; $i<sizeof($json_data); $i++){
    if ($json_data[$i]['username'] == $username){
        for ($j = 0; $j<sizeof($json_data[$i]['favorites']); $j++){
            if($json_data[$i]['favorites'][$j]['title'] == $_GET['title']){
                array_splice($json_data[$i]['favorites'], $j, 1);
                break;
            }
        }
        break;
    }
}
echo(json_encode($json_data));
$my_file = 'users.json';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
fwrite($handle, json_encode($json_data));
fclose($handle);
?> 