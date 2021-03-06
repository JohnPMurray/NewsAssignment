<?php
include 'sharedFunctions.php';
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
session_start();
//get the parameters from URL
$username=$_SESSION['username'];
$json=file_get_contents("./users.json");
$json_data= json_decode($json,true);
$articles = array();
foreach ($json_data as $user){
    if ($user['username'] == $username){
        foreach($user['favorites'] as $favorite){
            $articles[] = new jsonarticle($favorite);
        }
        break;
    }
}

usort($articles, "cmp");

foreach ($articles as $x){
    echo ("<div class='article container rounded'><div class='row'><div class='col'><a style='font-size:20px;' class='float-left aticle-title' id=".cleanString($x->title)." href='" . $x->link
    . "'>" . $x->title . "</a></div>");
    echo("<div class='col-md-6'><button class='rounded btn-primary float-right' id='".cleanString($x->title)."-button' onclick=\"unfavoriteAndRefresh('".cleanString($x->title)."')\">Unfavorite</button></div>");
    echo("</div>");
    echo ("<div id='".cleanString($x->title)."-desc'>$x->desc</div>");
    echo("<div id='".cleanString($x->title)."-date'>" . $x->pub_date->format('m/d/Y g:i A') . "</div>");
    echo("</div>");

}
?>