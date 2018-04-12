<html>
<?php
ini_set('display_errors', 1);
error_reporting(~0);
session_start();
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

                //assemble string based on current selections
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

                xmlhttp.open("GET", rssString, true);
                xmlhttp.send();
            }

            function favorite(title) {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {

                    }
                }
                link = document.getElementById(title).href
                desc = document.getElementById(title+"-desc").innerHTML
                date = document.getElementById(title+"-date").innerHTML

                xmlhttp.open("GET", "setFavorites.php?title="+title+"&link="+link+"&desc="+desc+"&date="+date, true);
                xmlhttp.send();
            }


            function showFavorites() {
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

                // document.write(rssString)
                xmlhttp.open("GET", "getFavorites.php", true);
                xmlhttp.send();
                }
        </script>
        <Title> News World </Title>
        <div id='nav-bar'><h1> News World </h1> 
        <?php if ($_SESSION["username"] == ""){?>
            <div align="right" display="inline"><a href="login.php" class="button">Login</a>
            Or 
            <a href="login.php" class="button">Sign Up</a></div></div>
        <?php } else { ?>
            <div align="right" display="inline"><a href="login.php" class="button">Logout</a></div></div>
        <?php } ?>
        <h2><i>Printing the news since 2018.</i></h2>
    </head>
    <body>
        <div><h3>News:</h3></div>
        <form>
            MLB<input type="checkbox" id="mlb" onchange="showRSS()" checked>
            NHL<input type="checkbox" id="nhl" onchange="showRSS()" checked>
            NFL<input type="checkbox" id="nfl" onchange="showRSS()" checked>
        </form>
        <?php if ($_SESSION["username"] != ""){
            echo("<button onclick=\"showFavorites()\">View Favorites</button>\n");
        }?>
        <script>showRSS();</script>
        <div id="rssOutput">
            ...Loading
        </div>
    </body>
</html>