<?php
  include "Auth/checkLogin.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Icons -->
  <script src="https://kit.fontawesome.com/fddbd6a824.js" crossorigin="anonymous"></script>
  <!-- Bootstap script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="https://getbootstrap.com/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
        iNote
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
            <img src="https://getbootstrap.com/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
          </h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav pe-3 d-lg-flex flex-grow-1">
            <li class="nav-link ms-2 ms-md-auto active d-md-none">
              Xin chào <?php echo $_SESSION['username'] ?>,
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2 active" aria-current="page" href="index.php">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a class="d-none d-md-block nav-link mx-2 px-2 btn btn-sm btn-primary px-3 text-white rounded-pill" data-bs-toggle="modal" data-bs-target="#createTopic">
                Tạo chủ đề
              </a>
            </li>
            <li class="nav-link ms-2 ms-md-auto active d-none d-md-block">
              Xin chào <?php echo $_SESSION['username'] ?>,
            </li>
            <li class="nav-item">
              <a class="nav-link ms-2 ms-md-0" aria-current="page" href="Auth/logout.php">
                Đăng xuất
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- Topic lists -->
  <div class="container">
    <!-- Success message -->
    <div class="position-fixed top-auto end-0 p-3" style="z-index: 11">
      <div id="createTopicMsg" class="toast bg-success text-white" role="alert" aria-atomic="true" data-bs-delay="3500">
        <div class="toast-body fs-5 fw-bold">
          <i class="fas fa-check-circle"></i>
          Thêm thành công
        </div>
      </div>
    </div>

    <!-- All topics -->
    <div id="topicLists" class="row row-cols-2 row-cols-md-5 g-4">
    </div>
  </div>

  <!-- Create topic button for mobile -->
  <div class="d-md-none d-flex justify-content-end fixed-bottom">
    <a class="px-3 btn btn-lg btn-primary rounded-pill mb-3 me-3" data-bs-toggle="modal" data-bs-target="#createTopic">
      Tạo chủ đề
    </a>
  </div>
  <!-- Modal create topic -->
  <div class="modal fade" id="createTopic" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="d-flex justify-content-end">
          <button class="btn btn-close rounded-pill me-1 mt-1" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <form id="createTopicForm" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
            <div class="mt-2 mb-4">
              <h1 class="card-title text-center">Tạo chủ đề mới</h1>
            </div>

            <div class="form-floating mt-3">
              <input type="text" id="topicName" class="form-control"  name="topicName" placeholder="Type topic name" required>
              <label class="form-label" for="topicName">Tên chủ đề</label>
              <div class="invalid-feedback">Vui lòng nhập tên chủ đề</div>
            </div>

            <div class="form-floating">
              <textarea name="topicDesc" class="form-control" placeholder="Type topic decription" id="topicDesc" style="height: 100px"></textarea>
              <label for="topicDesc" class="form-label">Mô tả</label>
            </div>

            <div class="mt-3">
              <label for="topicImg" class="form-label">Chọn ảnh đại diện</label>
              <input class="form-control" type="file" id="topicImg" name="topicImg" required>
              <div class="invalid-feedback">Vui lòng chọn ảnh đại diện</div>
            </div>
            <div class="d-flex justify-content-end">
              <button id="addTopic" name="addTopic" class="btn btn-success end-0 px-3 my-3 btn-lg">Lưu</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


<!-- ============================= Script ======================================================== -->
<!-- AJAX -->
<script>
  $(document).ready(function(){
    // Get all topics
    function getTopic(){
      $.ajax({
        url: "topic/topic.php",
        type: "POST",
      }).done(function(data){
        console.log(data);
        $("#topicLists").html(data);
      });
    }
    getTopic();
    // Insert topic
    $('#addTopic').on('click', function(e){
      e.preventDefault();
      const createTopicForm = $("#createTopicForm")[0];
      if(!createTopicForm.checkValidity()){
        createTopicForm.classList.add('was-validated');
      }else {
        $.ajax({
          url: "topic/postTopic.php",
          type: "POST",
          contentType: false,
          processData: false,
          data: new FormData(createTopicForm),
        })
        .done(function(){
          // Hide modal and reset form
          $("#createTopicForm")[0].reset();
          $("#createTopic").modal('hide');

          // Show success message
          let successMsg = new bootstrap.Toast($("#createTopicMsg")[0]);
          successMsg.show();

          getTopic();
        });
      }
    })
  });
</script>

</body>
</html>