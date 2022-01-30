<?php
  $severname = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbName = "inote";

  // Create connection
  $conn = new mysqli($severname, $dbUsername, $dbPassword, $dbName);
  $conn->set_charset("utf8");

  // Check connection 
  if ($conn->connect_error) {
    echo "Kết nối cơ sở dữ liệu không thành công";
  }

  // Code
?>