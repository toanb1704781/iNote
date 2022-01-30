<?php
  session_start();

  if(isset($_POST["login"])){
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordMd5 = md5($password);

    // Connect Database
    include "../database/connect.php";

    // Select account
    $sql = "SELECT userId, username 
            FROM users 
            WHERE (username = '$username' && password = '$passwordMd5')";

    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $user = $result->fetch_assoc();
      $_SESSION["userId"] = $user["userId"];
      $_SESSION["username"] = $user["username"];
      header("location: ../index.php");

    }else{
      echo "<script>";
      echo "alert('Tài khoản hoặc mật khẩu không chính xác')";
      echo "</script>";
      header("refresh: 0; url=login.php");
    }

    // Close connection
    $conn->close();
  }
?>