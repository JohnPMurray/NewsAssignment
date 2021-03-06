<!DOCTYPE html>
<html>
    <header>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        session_start();
        $loginMsg = null;
        if(isset($_POST["username"]) && isset($_POST["password"])){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $json=file_get_contents("./users.json");
            $json_data= json_decode($json,true);
            foreach ($json_data as $user){
                if ($user['username'] == $username){
                    if($user['password'] == $password){
                        $_SESSION['username'] = $username;
                        echo("<script>window.location.replace('./newsSite.php');</script>");
                    } else {
                        $loginMsg = "Invalid Password";
                        break;
                    }
                }
            }
            if ($loginMsg == null){
                $loginMsg = "Invalid Username";
            }
        }
            ?>
        <title>News World Login</title>
    </header>
    <body>
        <div class="container login-window rounded">
        <form action="login.php" method="post">
            <h1>Login</h1>
            <input type="text" placeholder="Username" name="username">
            <br>
            <input type="password" placeholder="Password" name="password">
            <br>
            <?php 
            if ($loginMsg != null){
                echo("<label id='login-failed'>$loginMsg</label><br>");
            }
            ?>
            <a href="newsSite.php">Cancel</a>
            <br>
            <button class="btn btn-md btn-primary btn-block" type="submit">Login</button>
        </form>
        </div>
    </body>
</html>