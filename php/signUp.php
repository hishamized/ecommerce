<?php
  require_once "../db/config.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST["signUp"])){
       $fullName = $_POST["fullName"];
       $userName = $_POST["userName"];
       $email = $_POST["email"];
       $password = $_POST["password"];
       $cpassword = $_POST["cpassword"];
       if($password == $cpassword){
         $param_fullName = trim($fullName);
         $param_userName = trim($userName);
         $param_email = trim($email);
         $param_Password = password_hash($password, PASSWORD_DEFAULT);
         $sql = "INSERT INTO `users` (`fullName`, `userName`, `email`, `password`) VALUES (?, ?, ?, ?);";
         $stmt = mysqli_prepare($conn, $sql);
         mysqli_stmt_bind_param($stmt, "ssss", $param_fullName, $param_userName, $param_email, $param_Password);
         $result = mysqli_stmt_execute($stmt);
         if ($result){
           echo("<script> alert(\"User has been registered successfully\") </script>");
           $stmt->close();
           $conn->close();
           unset($_POST["signUp"]);
           header("location: signUp.php");
         }else{
           echo("Failed to sign up due to an error" . mysqli_error($conn));
           unset($_POST["signUp"]);
         }
       }else{
         echo("<h2> Passwords do not match </h2> <br>");
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
    <form action="#" method="post">
      <div>
        <label for="fullName">Full Name:</label>
        <input type="text" name="fullName" id="fullName" required>
      </div>
      <div>
        <label for="userName">Username:</label>
        <input type="text" name="userName" id="userName" required>
      </div>
      <div>
       <label for="email">Email:</label>
       <input type="email" name="email" id="email" required>
      </div>
      <div>
       <label for="password">Password:</label>
       <input type="password" name="password" id="password" required>
      </div>
      <div>
       <label for="cpassword">Confirm Password:</label>
       <input type="password" name="cpassword" id="cpassword" required>
      </div>
      <div>
        <button type="submit" name="signUp">Sign Up</button>
      </div>
    </form>
 </section>
</body>
</html>