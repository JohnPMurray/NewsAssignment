<?php 
    function cleanString($string){
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); //remove all special characters
}

function home(){
    window.location.replace('./newsSite.php');
}

?>