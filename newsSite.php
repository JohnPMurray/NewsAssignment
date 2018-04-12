<html>
<?php
ini_set('display_errors', 1);
error_reporting(~0);
?>
    <head>
        
        <script>
            function showRSS() {
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
                rssString += "nhl=true";
            } else {
                rssString += "nhl=false";
            }
            if (document.getElementById("nfl").checked){
                rssString += "&nfl=true";
            } else {
                rssString += "&nfl=false";
            }
            if (document.getElementById("mlb").checked){
                rssString += "&mlb=true";
            } else {
                rssString += "&mlb=false";
            }

            // document.write(rssString)
            xmlhttp.open("GET", rssString, true);
            xmlhttp.send();
            }
        </script>
        <Title> News World </Title>
        <h1> News World </h1>
        <h2><i>Printing the news since 2018.</i></h2>
    </head>
    <body>
        <a href="login.php" class="button">Login</a>
        Or
        <a href="login.php" class="button">Sign Up</a>
        <div><h3>News:</h3></div>
        <form>
            MLB<input type="checkbox" id="mlb" onchange="showRSS()" checked>
            NHL<input type="checkbox" id="nhl" onchange="showRSS()" checked>
            NFL<input type="checkbox" id="nfl" onchange="showRSS()" checked>
        </form>
        <script>showRSS()</script>
        <div id="rssOutput">
            ...Loading
        </div>
    </body>
</html>