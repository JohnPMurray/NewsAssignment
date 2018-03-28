<html>
    <head>
        
        <script>
            function showRSS(str) {
            if (str.length==0) { 
                document.getElementById("rssOutput").innerHTML="";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                document.getElementById("rssOutput").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","getrss.php?q="+str,true);
            xmlhttp.send();
            }
        </script>
        <Title> News World </Title>
        <h1> News World </h1>
        <h2><i>Printing the news since 2018.</i><h2>
    </head>
    <body>
        <div><h3>News:</h3></div>
        <form>
            <select onchange="showRSS(this.value)">
            <option value="">All</option>
            <option value="Sports">Top Headlines</option>
            <option value="World">NFL News</option>
            <option value="NBA">NBA News</option>
            <option value="MLB">MLB News</option>
            <option value="NHL">NHL News</option>
            </select>
        </form>
        <div id="rssOutput">
            <?php
                $xmlDoc = new DOMDocument();
                $docPageList = array("http://feeds.bbci.co.uk/news/world/rss.xml",
                                    "http://www.espn.com/espn/rss/news" )
                for ($j=0; $j < sizeof($docPageList); $j++){
                    $xmlDoc->load($docPageList[$j]);
                    $x=$xmlDoc->getElementsByTagName('item');
                    for ($i=0; $i<=2; $i++) {
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
        </div>
    </body>
</html>