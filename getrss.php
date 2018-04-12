<?php

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
ini_set('display_errors', 1);
error_reporting(~0);
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
    echo ("<div><a id=".$x->title." href='" . $x->link
    . "'>" . $x->title . "</a>");
    if ($_SESSION['usersname'] != ""){
        echo("<button align='right' onclick=\"favorite('".str_replace(' ', '', $x->title)."')\">Favorite</button>");
    }
    echo("</div>");
    echo ("<div id='".str_replace(' ', '', $x->title)."-desc'>$x->desc</div>");
    echo("<div id='".str_replace(' ', '', $x->title)."-date'>" . $x->pub_date->format('m/d/Y g:i A') . "</div><br>");
}
?>