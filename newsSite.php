<html>
<?php
ini_set('display_errors', 1);
error_reporting(~0);
session_start();
?>
    <head>
        
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/newsStyles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    document.getElementById("favorites").onclick = function(){ showFavorites() };
                    document.getElementById("favorites").innerHTML = "Favorites";
                    document.getElementById("news-heading").innerHTML = "Recent News:";
                    document.getElementById("checkboxes").style.visibility="visible";
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

            function unfavoriteAndRefresh(title){
                unfavorite(title);
                showFavorites();
            }
            
            function unfavorite(title){
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {
                        document.getElementById(title+"-button").onclick = function() { favorite(title); }
                        document.getElementById(title+"-button").innerHTML = "Favorite";
                    }
                }

                verbosetitle = document.getElementById(title).innerHTML

                xmlhttp.open("GET", "unsetFavorites.php?title="+verbosetitle, true);
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
                        document.getElementById(title+"-button").onclick = function() { unfavorite(title); }
                        document.getElementById(title+"-button").innerHTML = "Unfavorite";
                    }
                }

                link = document.getElementById(title).href
                desc = document.getElementById(title+"-desc").innerHTML
                date = document.getElementById(title+"-date").innerHTML
                verbosetitle = document.getElementById(title).innerHTML

                xmlhttp.open("GET", "setFavorites.php?title="+verbosetitle+"&link="+link+"&desc="+desc+"&date="+date, true);
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
                        document.getElementById("favorites").onclick = function(){ showRSS() };
                        document.getElementById("favorites").innerHTML = "Recent News";
                        document.getElementById("news-heading").innerHTML = "Favorites:";
                        document.getElementById("checkboxes").style.visibility="hidden";


                    }
                }

                // document.write(rssString)
                xmlhttp.open("GET", "getFavorites.php", true);
                xmlhttp.send();
                }

            function logout() {
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

                xmlhttp.open("GET", "logout.php", true);
                xmlhttp.send();
            }
        </script>
        <Title> News World </Title>
    </head>
    <body>

        <div class="row container-fluid" id="nav-bar">
            <div class="col-md-6"><h1> News World </h1></div> <div class="col-md-6"><span class="float-right">
        <?php if ($_SESSION["username"] == ""){?>
            <a href="login.php"><u>Login</u></a>
            Or 
            <a href="signup.php"><u>Sign Up</u></a></span></div></div>

        <?php } else { ?>
            <a onclick="logout()"><u>Logout</u></a></span></div></div>
        <?php } ?>
        <h2><i>Printing the news since 2018.</i></h2>
        <div><h3 id="news-heading">Recent News:</h3></div>
        <form id="checkboxes">
            MLB<input type="checkbox" id="mlb" onchange="showRSS()" checked>
            NHL<input type="checkbox" id="nhl" onchange="showRSS()" checked>
            NFL<input type="checkbox" id="nfl" onchange="showRSS()" checked>
        </form>
        <?php if ($_SESSION["username"] != ""){
            echo("<button id='favorites' onclick=\"showFavorites()\">View Favorites</button>\n");
        }?>
        <script>showRSS();</script>
        <div id="rssOutput">
            ...Loading
        </div>
    </body>
</html>