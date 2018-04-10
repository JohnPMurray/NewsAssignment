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
    $this->$desc=$x->item($i)->getElementsByTagName('description')
        ->item(0)->childNodes->item(0)->nodeValue;
    $pub_date=$x->item($i)->getElementsByTagName('pubDate')
        ->item(0)->childNodes->item(0)->nodeValue;
    $this->$pub_date= date_create_from_format('D, j M Y H:i:s T', $pub_date);
    
}
}

ini_set('display_errors', 1);
error_reporting(~0);
//get the q parameter from URL
$q=$_GET["q"];
$xmlDoc = new DOMDocument();
$docPageList = array("NFL" => "http://www.espn.com/espn/rss/nfl/news",
                     "MLB" => "http://www.espn.com/espn/rss/mlb/news",
                     "NHL" => "http://www.espn.com/espn/rss/nhl/news"  );
if ($q != "All"){
    $docPageList = array($q => $docPageList[$q]);
}
foreach ($docPageList as $key => $value){
    echo("<h3><b>" . $key . "</b></h3>");
    $xmlDoc->load($value);
    $x=$xmlDoc->getElementsByTagName('item');
    for ($i=0; $i<=10; $i++) {

        $x = new article($x, $i);
        echo ("<p><a href='" . $x->link
        . "'>" . $x->title . "</a>");
        echo ("<br>");
        echo ($x->desc);
        echo ("<br>");
        echo("$x->pub_date </p>");

    }
}
?>