<?php
//get the q parameter from URL
$q=$_GET["q"];

$xmlDoc = new DOMDocument();
$docPageList = array("Top" => "http://www.espn.com/espn/rss/news",
                    "MLB" => "http://www.espn.com/espn/rss/mlb/news",
                    "NFL" => "http://www.espn.com/espn/rss/nfl/news" );

if ($q != "All"){
    $docPageList = array($q => $docPageList[$q]);
}

for ($j=0; $j < sizeof($docPageList); $j++){
    echo("<h3><b>" . array_search($docPageList[$j], $docPageList) . "</b></h3>");
    $xmlDoc->load($docPageList[$j]);
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