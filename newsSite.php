<html>
    <header>
        
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="http://www.google.com/uds/solutions/dynamicfeed/gfdynamicfeedcontrol.js"
        type="text/javascript"></script>

        <style type="text/css">
        @import url("http://www.google.com/uds/solutions/dynamicfeed/gfdynamicfeedcontrol.css");

        #feedControl {
        margin-top : 10px;
        margin-left: auto;
        margin-right: auto;
        width : 440px;
        font-size: 12px;
        color: #9CADD0;
        }
        </style>
        <script type="text/javascript">
        function load() {
        var feed ="http://www.espn.com/espn/rss/news";
        new GFdynamicFeedControl(feed, "feedControl");

        }
        google.load("feeds", "1");
        google.setOnLoadCallback(load);
        </script>
        <Title> News World </Title>
        <h1> News World </h1>
        <h2><i>Printing the news since 2018.</i><h2>
    </header>
    <body>
        <div><h3>News:</h3></div>
        <div>
        <div id="feedControl">Loading...</div>
        </div>
    </body>
</html>