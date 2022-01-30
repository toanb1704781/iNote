<?php
if(isset($_POST["register"])){
  // Get data
  $username = $_POST["username"];
  $password = $_POST["password"];
  $passwordMD5 = md5($password);
  $userId = rand(1000, 9999);

  // Open connection
  include "../database/connect.php";

  // Insert SQL
  $sql = "INSERT INTO users (userId, username, password) VALUES ('$userId', '$username', '$passwordMD5')";
  if ($conn->query($sql) === true) {
    echo "Đăng ký thành công";
    header( "refresh:2;url=login.php" );
  }else{
    echo "Đăng ký không thành công";
    header( "refresh:2;url=register.php" );
  }

  // Close connection
  $conn->close();
}else{
  header("location:Auth/register.php");
}
?>