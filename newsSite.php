<html>
<?php
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

        </script>
        <Title> News World </Title>
    </head>
    <body>

        <div class="row container-fluid" id="nav-bar">
            <div class="col"><h1> News World </h1></div> <div class="col-md-6"><span class="float-right">
        <?php if ($_SESSION["username"] == ""){?>
            <a href="login.php"><u>Login</u></a>
            Or 
            <a href="signup.php"><u>Sign Up</u></a></span></div>

        <?php } else { ?>
            <a href="logout.php"><u>Logout</u></a></span></div>
        <?php } ?>
        <!-- <h2><br><i>Printing the news since 2018.</i></h2> -->
        </div>
        <br>
        <div class="row container-fluid"><h3 id="news-heading" class="col">Recent News:</h3>
        <form id="checkboxes" class="col-md-6">
            <div class="ck-button">
            <label>
                <input type="checkbox" checked id="mlb" onchange="showRSS()"><span>MLB</span>
            </label>
            </div>
            <div class="ck-button">
            <label>
                <input type="checkbox" checked id="nhl" onchange="showRSS()"><span>NHL</span>
            </label>
            </div>
            <div class="ck-button">
            <label>
                <input type="checkbox" checked id="nfl" onchange="showRSS()"><span>NFL</span>
            </label>
            </div>
        </form>
        <?php if ($_SESSION["username"] != ""){
            echo("<button id='favorites' class='col-md-2 float right' onclick=\"showFavorites()\">View Favorites</button>\n");
        }?>
        </div>
        <script>showRSS();</script>
        <div id="rssOutput">
            ...Loading
        </div>
    </body>
</html>