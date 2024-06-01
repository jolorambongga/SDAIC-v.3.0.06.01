<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'/>
	<link rel='stylesheet' href='../includes/css/my_css.css'/>
	<link rel='stylesheet' href='../includes/css/my_radio.css'/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
	<!-- nav bar -->
	<nav class="navbar navbar-expand-lg sticky-md-top shadow-sm" style="background-color: #FFC000;">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php" style="color: black;">
				<img src="https://www.logolynx.com/images/logolynx/2a/2ad00c896e94f1f42c33c5a71090ad5e.png" alt="Logo"
				width="30" height="auto" class="d-inline-block align-text-top">
				STA. MARIA DIAGNOSTIC AND IMAGING CENTER
			</a>
		</div>
	</nav>
	<!-- end nav bar -->

	<!-- header -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 d-flex align-items-end" style="background-color: whitesmoke;">
				<ul class="nav nav-tabs my_nav">
					<li class="nav-item">
						<a class="nav-link <?php echo $active_index ?>" href="index.php">Homepage</a>
					</li>
				</ul>
				<!-- Add "active" class to the selected tab -->
				<ul class="nav nav-tabs my_nav">
					<li class="nav-item">
						<a class="nav-link <?php echo $active_profile ?>" href="profile.php">Profile</a>
					</li>
				</ul>
				<ul class="nav nav-tabs my_nav">
					<li class="nav-item">
						<a class="nav-link <?php echo $active_your_appointments ?>" href="your_appointments.php">Your Appointments</a>
					</li>
				</ul>
				<ul class="nav nav-tabs my_nav">
					<li class="nav-item">
						<a class="nav-link <?php echo $active_new_appointment ?>" href="new_appointment.php">New Appointment</a>
					</li>
				</ul>
			</div>
			<div class="col-md-6 d-flex justify-content-end" style="background-color: hotpink;">
				<!-- IF SET CONDITION FOR BUTTONS -->
				<button type="button" class="btn btn-primary me-2 mt-2 mb-2">Register</button>
				<button type="button" class="btn btn-primary me-2 mt-2 mb-2">Log-In</button>
			</div>
		</div>
	</div>

	<!-- end header -->