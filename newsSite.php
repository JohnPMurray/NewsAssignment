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
        <button onclick="showRSS('http://www.espn.com/espn/rss/news')">feed Me</button>
        <div>
        <div id="rssOutput">Loading...</div>
        </div>
    </body>
</html>