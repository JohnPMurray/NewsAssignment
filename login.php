<!DOCTYPE html>
<html>
    <header>
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
        <h1>Login</h1>
    </header>
    <body>
        <form action="login.php" method="post">
            Username: <input type="text" name="username">
            <br>
            Password: <input type="password" name="password">
            <br>
            <?php 
            if ($loginMsg != null){
                echo("<label id='login-failed'>$loginMsg</label><br>");
            }
            ?>
            <button type="submit" formaction="newsSite.php">Cancel</button>
            <button type="submit">Login</button>
        </form>
    </body>
</html>