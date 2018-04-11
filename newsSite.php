<html>
<?php
ini_set('display_errors', 1);
error_reporting(~0);
?>
    <head>
        
        <script>
            function showRSS() {
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

            //assemble steing based on current selections
            var rssString = "getrss.php?"
            if (document.getElementById("nhl").checked){
                rssString.concat("nhl=true")
            } else {
                rssString.concat("nhl=false")
            }
            if (document.getElementById("nfl").checked){
                rssString.concat("&nfl=true")
            } else {
                rssString.concat("&nfl=false")
            }
            if (document.getElementById("mlb").checked){
                rssString.concat("&mlb=true")
            } else {
                rssString.concat("&mlb=false")
            }

            xmlhttp.open("GET",rssString,true);
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
            MLB<input id="checkBox" type="checkbox" id="mlb" onchange="showRSS()">
            NHL<input id="checkBox" type="checkbox" id="nhl" onchange="showRSS()">
            NFL<input id="checkBox" type="checkbox" id="nfl" onchange="showRSS()">
        </form>
        <script>showRSS("All")</script>
        <div id="rssOutput">
            ...Loading
        </div>
    </body>
</html>