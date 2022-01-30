<?php
  // Check user session
  include "../Auth/checkLogin.php";

  // Open connection
  include "../database/connect.php";

  // Get user
  $userId = $_SESSION["userId"];

  // Insert
  if(isset($_POST['topicName'])) {
    $topicId = rand(1000,9000);
    $topicName = $_POST["topicName"];
    $topicDesc = $_POST["topicDesc"] ?? "";
    $filename = $topicId."_".$_FILES["topicImg"]["name"];
    $path = "uploads/".$filename;
    $created_by = $userId;
    $sql = "INSERT INTO topics(topicId, topicName, topicDesc, topicImg, created_by)
            VALUES ('$topicId', '$topicName', '$topicDesc', '$path', '$created_by')";
    move_uploaded_file($_FILES["topicImg"]["tmp_name"], "../".$path);
    $conn->query($sql);
  }

  // Close connection
  $conn->close();
  
?>