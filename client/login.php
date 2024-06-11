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
          <form method="post" id="frm_login">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="login" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-4"></div>
            <div class="form-group">
              <input value="Log In" id="btnLogin" type="submit" class="btn btn-primary btn-block">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  $(document).ready(function() {
    $('#btnLogin').click(function () {
      $.ajax({
        type: 'GET',
        url: 'handles/login_endpoint.php',
        data: {}
        dataType: 'JSON',
        success: function(response) {

        },

      });
    });
  });
</script>

<?php
include_once('footer.php');
?>