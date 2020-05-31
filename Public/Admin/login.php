<?php
require_once('../../includes/init.php');

if($session->is_logged_in()){ 
    header('location: index.php');
};

// handle the form submit #endregion
if(isset($_POST['username'])){
   
    $username =trim($_POST['username']);
    $password = trim($_POST['password']);

    // check username and password
    $found_user = User::Authenticate($username, $password);
    
    if($found_user){
        $session->login($found_user);
        log_action('login', "{$found_user->username} logged in.");
       // header('location: index.php');
    }else{
        $mesage = 'username or password is inncorect';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../stylesheets/login.css" />
    <script src="main.js"></script>
</head>
<body>


<div class="log-form">
  <h2>Login to your account</h2>
  <form action="login.php" method="post">
    <input type="text" name='username' title="username" placeholder="username" />
    <input type="password" name='password' title="username" placeholder="password" />
    <input type="submit" class="btn">
    <a class="forgot" href="#">Forgot Username?</a>
  </form>
</div><!--end log form -->
</body>
</html>