<?php

include 'sharedFunctions.php';

class article
{
  public $title;
  public $link;
  public $desc;
  public $pub_date;
  function __construct($x) {
    $this->title = $x->getElementsByTagName('title')
      ->item(0)->childNodes->item(0)->nodeValue;
    $this->link=$x->getElementsByTagName('link')
        ->item(0)->childNodes->item(0)->nodeValue;
    $this->desc=$x->getElementsByTagName('description')
        ->item(0)->childNodes->item(0)->nodeValue;
    $pub_date=$x->getElementsByTagName('pubDate')
        ->item(0)->childNodes->item(0)->nodeValue;
    $this->pub_date= date_create_from_format('D, j M Y H:i:s T', $pub_date);
    
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
$mlb=$_GET["mlb"];
$nfl=$_GET["nfl"];
$nhl=$_GET["nhl"];
$xmlDoc = new DOMDocument();
$docPageList = array();
if ($mlb == "true"){
    $docPageList[] = "http://www.espn.com/espn/rss/mlb/news";
}
if ($nfl == "true"){
    $docPageList[] = "http://www.espn.com/espn/rss/nfl/news";
}
if ($nhl == "true"){
    $docPageList[] = "http://www.espn.com/espn/rss/nhl/news";
}
$articles = array();
foreach ($docPageList as $value){
    $xmlDoc->load($value);
    $x=$xmlDoc->getElementsByTagName('item');
    for ($i=0; $i<=10; $i++) {

        $article = new article($x->item($i));
        $articles[] = $article;

    }
}

usort($articles, "cmp");

foreach ($articles as $x){
    echo ("<div class='article container rounded'><div class='row'><div class='col'><a class='float-left aticle-title' id=".cleanString($x->title)." href='" . $x->link
    . "'><u>" . $x->title . "</u></a></div>");
    if ($_SESSION['username'] != ""){

        //check if article is favorited
        $fav = False;
        $json=file_get_contents("./users.json");
        $json_data= json_decode($json,true);
        $articles = array();
        foreach ($json_data as $user){
            if ($user['username'] == $_SESSION['username']){
                foreach($user['favorites'] as $favorite){
                    if ($favorite['title'] == $x->title){
                        echo("<div class='col-md-6'><button class='float-right' id='".cleanString($x->title)."-button' onclick=\"unfavorite('".cleanString($x->title)."')\">Unfavorite</button></div>");
                        $fav = True;
                        break;
                    }
                }    
                break;
            }
        }
        if ($fav==False){
            echo("<div class='col-md-6'><button class='float-right' id='".cleanString($x->title)."-button' onclick=\"favorite('".cleanString($x->title)."')\">Favorite</button></div>");
        }
        
    }
    echo("</div>");
    echo ("<div id='".cleanString($x->title)."-desc'>$x->desc</div>");
    echo("<div id='".cleanString($x->title)."-date'>" . $x->pub_date->format('m/d/Y g:i A') . "</div><br>");
    echo("</div>");
}
?>