
<?php
ini_set('display_errors', 1);
error_reporting(~0);
//get the q parameter from URL
$q=$_GET["q"];
$xmlDoc = new DOMDocument();
$docPageList = array("World News" => "http://feeds.bbci.co.uk/news/world/rss.xml",
                    "US News" => "http://www.cnbc.com/id/15837362/device/rss/rss.html",
                    "Sports News" => "http://www.espn.com/espn/rss/news" );
$titles("World News", "US News", "Sports News");
if ($q != "All"){
    $docPageList = array($q => $docPageList[$q]);
}
for ($j=0; $j < sizeof($docPageList); $j++){
    echo("<h3><b>" . titles[$j] . "</b></h3>");
    $xmlDoc->load($docPageList[titles[$j]]);
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
