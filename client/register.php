<?php
$title = "REGISTER ITO";
$active_register = "active";
include_once('header.php');
?>	

<link rel="stylesheet" href="../includes/css/my_register.css">

<div class="my-wrapper">
<div class="register-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h1>Register</h1>
        <form>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstName" aria-describedby="firstName" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="middleName" class="form-label">Middle Name</label>
              <input type="text" class="form-control" id="middleName" aria-describedby="middleName">
            </div>
            <div class="col-md-4 mb-3">
              <label for="surname" class="form-label">Surname</label>
              <input type="text" class="form-control" id="surname" aria-describedby="surname" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="contact" class="form-label">Contact</label>
              <input type="tel" class="form-control" id="contact" aria-describedby="contact" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="birthday" class="form-label">Birthday</label>
              <input type="date" class="form-control" id="birthday" aria-describedby="birthday" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control" id="address" rows="3" required></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" aria-describedby="email" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" aria-describedby="username" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" aria-describedby="password" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php
include_once('footer.php');
?>	