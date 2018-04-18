<!DOCTYPE html>
<html>
    <header>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php
$loginMsg = null;
if(isset($_POST["username"]) && isset($_POST["password"])){
    date_default_timezone_set('America/New_York');
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
        $loginMsg = "User already exists."
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
            <button type="submit" class="btn btn-md btn-primary btn-block">Sign Up</button>
        </form>
        </div>
    </body>
</html>