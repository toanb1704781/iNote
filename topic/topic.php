<?php
  // Check user session
  include "../Auth/checkLogin.php";

  // Open connection
  include "../database/connect.php";

  // Get user
  $userId = $_SESSION["userId"];

  // Select
  $sql = "SELECT * FROM topics WHERE (created_by = '$userId') ORDER BY created_at DESC";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $topicLists = "";
    while($topic = $result->fetch_assoc()) {
      $topicLists .= "
        <div class='col'>
        <div class='card h-100'>
          <img src='".$topic['topicImg']."' class='card-img-top' style='height: 200px'>
          <div class='card-body bg-light'>
            <h5 class='text-center card-title'>".$topic['topicName']."</h5>
            <a href='' class='stretched-link'></a>
          </div>
        </div>
      </div>
      ";
    }
    echo $topicLists;
  }

  // Close connection
  $conn->close();
  
?>