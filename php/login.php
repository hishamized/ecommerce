<?php
  require_once "../db/config.php";

  if(isset($_SESSION['username']) && $_SESSION['loggedIn'] == true) {
      header("location: ladning.php");
      exit;
    }

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['login'])){
        $userName = trim($_POST['userName']);
        $password = trim($_POST['password']);

        $sql = "SELECT `user_id`, `userName`, `password` FROM `users` WHERE `userName` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $userName;

        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $id, $userName, $hashedPassword);
            if(mysqli_stmt_fetch($stmt)){
              if(password_verify($password, $hashedPassword)){
                 session_start();
                 $_SESSION['userName'] = $userName;
                 $_SESSION['id'] = $id;
                 $_SESSION['loggedIn'] = true;

                  header("location: ../landing.php");
              }else{
                 echo("<script>alert(\"Incorrect Password!\")</script>");
              }
            }
          }else{
              echo("<script>alert(\"No such user exists!\")</script>");
          }
        }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title> Landing Page </title>
</head>
<body>
 <section>
    <form action="login.php" method="post">
      <div>
       <label for="userName">Username:</label>
       <input type="text" name="userName" id="userName">
      </div>
      <div>
         <label for="password">Password:</label>
         <input type="password" name="password" id="password">
      </div>
      <div>
        <button type="submit" name="login">Login</button>
      </div>
    </form>
 </section>
</body>
</html>