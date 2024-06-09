<?php
$title = "LOGIN ITO";
$active_login = "active";
include_once('header.php');
?>

<link rel="stylesheet" href="../includes/css/my_login.css">

<div class="my-wrapper">
<div class="login-wrapper">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="login-box">
          <h1 class="text-center mb-4">Log In</h1>
          <form action="client/login.php" method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-4"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
include_once('footer.php');
?>