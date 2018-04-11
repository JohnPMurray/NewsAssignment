<?php

class article
{
  public $title;
  public $link;
  public $desc;
  public $pub_date;
  function __construct($x, $i) {
    $this->title = $x->item($i)->getElementsByTagName('title')
      ->item(0)->childNodes->item(0)->nodeValue;
    $this->link=$x->item($i)->getElementsByTagName('link')
        ->item(0)->childNodes->item(0)->nodeValue;
    $this->desc=$x->item($i)->getElementsByTagName('description')
        ->item(0)->childNodes->item(0)->nodeValue;
    $pub_date=$x->item($i)->getElementsByTagName('pubDate')
        ->item(0)->childNodes->item(0)->nodeValue;
    $this->pub_date= date_create_from_format('D, j M Y H:i:s T', $pub_date);
    
}
}

function cmp($a, $b){
    if ($a->pub_date == $b->pub_date){
        return 0;
    }
    return ($a->pub_date < $b->pub_date) ? -1 : 1;
}

// ini_set('display_errors', 1);
// error_reporting(~0);
//get the q parameter from URL
$q=$_GET["q"];
$xmlDoc = new DOMDocument();
$docPageList = array("NFL" => "http://www.espn.com/espn/rss/nfl/news",
                     "MLB" => "http://www.espn.com/espn/rss/mlb/news",
                     "NHL" => "http://www.espn.com/espn/rss/nhl/news"  );
if ($q != "All"){
    $docPageList = array($q => $docPageList[$q]);
}
$articles = array();
foreach ($docPageList as $value){
    $xmlDoc->load($value);
    $x=$xmlDoc->getElementsByTagName('item');
    for ($i=0; $i<=10; $i++) {

        $article = new article($x, $i);
        $articles[] = $article;

    }
}

usort($articles, "cmp");

foreach ($articles as $x){
    echo ("<p><a href='" . $x->link
    . "'>" . $x->title . "</a>");
    echo ("<br>");
    echo ($x->desc);
    echo ("<br></p>");
    echo("$x->pub_date </p>");
}
?>