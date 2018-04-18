<!DOCTYPE html>
<html>
    <header>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php
if(isset($_POST["username"]) && isset($_POST["password"])){
    date_default_timezone_set('America/New_York');
    ini_set('display_errors', 1);
    error_reporting(~0);
    session_start();
    //get the parameters from URL
    $userExists=False;
    $username=$_POST['username'];
    $password=$_POST['password'];
    $newUser=array("username"=>$username,
                "password"=>$password,
                "favorites"=>array());
    $json=file_get_contents("./users.json");
    $json_data= json_decode($json,true);
    for ($i = 0; $i<sizeof($json_data); $i++){
        if ($json_data[$i]['username'] == $username){
            $userExists = True;
        }
    }
    if(!$userExists){
        $json_data[] = $newUser;
        $_SESSION['username'] = $username;
        echo("<script>window.location.replace('./newsSite.php');</script>");
    }
    else{
        echo("<script>document.getElementById(title).innerHTML = 'Username already exists.';</script>");
    }
    $my_file = 'users.json';
    $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
    fwrite($handle, json_encode($json_data));
    fclose($handle);
}
?>

        <title>News World Sign Up</title>
    </header>
    <body>
        <div class="container login-window rounded">
        <form action="signup.php" method="post">
            <h1>Sign Up</h1>
            Username: <input type="text" name="username">
            <br>
            Password: <input type="password" name="password">
            <br>
            <?php 
            if ($loginMsg != null){
                echo("<label id='login-failed'>$loginMsg</label><br>");
            }
            ?>
            <a href="newsSite.php">Cancel</a>
            <button type="submit">Sign Up</button>
        </form>
        </div>
    </body>
</html>