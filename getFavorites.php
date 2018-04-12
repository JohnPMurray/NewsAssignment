<?php

class jsonarticle
{
  public $title;
  public $link;
  public $desc;
  public $pub_date;
  function __construct($favorite) {
    $this->title = $favorite['title'];
    $this->link = $favorite['link'];
    $this->desc= $favorite['desc'];
    $pub_date= $favorite['pub_date'];
    $this->pub_date= date_create_from_format('m/d/Y g:i A', $pub_date);
    
    }
}

function cmp($a, $b){
    if ($a->pub_date == $b->pub_date){
        return 0;
    }
    return ($a->pub_date > $b->pub_date) ? -1 : 1;
}

date_default_timezone_set('America/New_York');
ini_set('display_errors', 1);
error_reporting(~0);
session_start();
//get the parameters from URL
$username=$_SESSION['username'];
$xmlDoc = new DOMDocument();
$json=file_get_contents("./favorites.json");
$json_data= json_decode($json,true);
$articles = array();
foreach ($json_data as $user){
    if ($user['user'] == $username){
        foreach($user['favorites'] as $favorite){
            $articles[] = new jsonarticle($favorite);
        }
        break;
    }
}

usort($articles, "cmp");

foreach ($articles as $x){
    echo ("<div id='".str_replace(' ', '', $x->title)."'><a href='" . $x->link
    . "'>" . $x->title . "</a></div>");
    echo ("<div id='".str_replace(' ', '', $x->title)."-desc'>$x->desc</div>");
    echo("<div id='".str_replace(' ', '', $x->title)."-date'>" . $x->pub_date->format('m/d/Y g:i A') . "</div>");
}
?>