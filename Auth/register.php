<?php
  session_start();
  // Check user session
  if (isset($_SESSION['userId'])) {
    header("location: ../index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng Ký</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Icons -->
  <script src="https://kit.fontawesome.com/fddbd6a824.js" crossorigin="anonymous"></script>
  <!-- Bootstap script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
</head>
<body class="h-100 pt-sm-5 d-sm-flex align-items-center bg-light">

<!-- Main -->
<div class="w-100 mt-sm-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="w-auto">
        <div class="card px-2 pb-4 mt-5 mt-sm-0" style="border-radius: 1rem;">
          <div class="card-body">

            <form id="signup-form" class="needs-validation" action="postRegister.php" method="POST" novalidate>
              <div class="mt-2 mb-4">
                <h1 class="card-title text-center">Đăng ký tài khoản</h1>
              </div>

              <div class="form-floating mt-3">
                <input type="text" id="userName" class="form-control"  name="username" placeholder="Type username" required>
                <label class="form-label" for="userName">Tên đăng nhập</label>
                <div class="invalid-feedback">Vui lòng nhập tên đăng nhập</div>
              </div>

              <div class="form-floating mt-2">
                <input type="password" id="passWord" class="form-control" name="password" placeholder="Type password" required>
                <label class="form-label" for="passWord">Mật khẩu</label>
                <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
              </div>

              <div class="form-floating mt-2">
                <input type="password" id="rePass" class="form-control" name="rePass" placeholder="Type password" required>
                <label class="form-label" for="rePass">Nhập lại mật khẩu</label>
                <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
              </div>

              <button type="submit" name="register" class="btn btn-primary w-100 btn-block px-3 mt-3 btn-lg">Đăng ký</button>
              <div class="text-center my-3">
                Đã có tài khoản? <a href="login.php">Đăng nhập</a>
              </div>
            </form>

            <!-- Social Button -->
            <button style="background-color: rgb(224, 62, 62);" class="text-white btn btn-block w-100">
              <i class="fab fa-google me-2"></i>
              Đăng nhập với Google
            </button>
            <button style="background-color: rgb(34, 34, 197);" class="text-white btn btn-block w-100 mt-1">
              <i class="fab fa-facebook-f me-2"></i>
              Đăng nhập với Facebook 
            </button>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Validation check -->
<script>
  (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const form = document.getElementById('signup-form');

    //Form check
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    })
  })()
</script>

</body>
</html>