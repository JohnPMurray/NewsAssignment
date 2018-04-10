<?php
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
        $item_title=$x->item($i)->getElementsByTagName('title')
        ->item(0)->childNodes->item(0)->nodeValue;
        $item_link=$x->item($i)->getElementsByTagName('link')
        ->item(0)->childNodes->item(0)->nodeValue;
        $item_desc=$x->item($i)->getElementsByTagName('description')
        ->item(0)->childNodes->item(0)->nodeValue;
        echo ("<p><a href='" . $item_link
        . "'>" . $item_title . "</a>");
        echo ("<br>");
        echo ($item_desc . "</p>");
    }
}
?>