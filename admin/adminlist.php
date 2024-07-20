<?php
session_start();
require ("config.php");
////code

if (!isset($_SESSION['auser'])) {
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Admin panel | Admin</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="assets/css/feathericon.min.css">

	<!-- Datatables CSS -->
	<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/plugins/datatables/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/plugins/datatables/select.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/plugins/datatables/buttons.bootstrap4.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>

	<!-- Main Wrapper -->


	<!-- Header -->
	<?php include ("header.php"); ?>
	<!-- /Sidebar -->

	<!-- Page Wrapper -->
	<div class="page-wrapper py-5">
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col">
						<h3 class="page-title">Admin</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
							<li class="breadcrumb-item active">Admin</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<div class=" d-flex justify-content-between">
								<h4 class="card-title">Admin List</h4>

								<button type="button" class="btn btn-primary text-light" data-toggle="modal"
									data-target="#add_admin">
									Add New Admin
								</button>
							</div>
							<?php
							if (isset($_GET['msg']))
								echo $_GET['msg'];
							?>

							<!-- Modal -->
							<div class="modal fade" id="add_admin" tabindex="-1" role="dialog"
								aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content col-md-10">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">
												Add New Admin</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="" method="POST">
												<div class="form-group">
													<label>Username</label>
													<input class="form-control" name="name" type="text"
														placeholder="Enter Username">
												</div>
												<div class="form-group">
													<label>Enter Email</label>
													<input class="form-control" name="email" type="email"
														placeholder="Emali">
												</div>
												<div class="form-group">
													<label>Date Of Birth</label>
													<input class="form-control" name="dob" type="date"
														placeholder="Enter date of birth">
												</div>
												<div class="form-group">
													<label>Phone Number</label>
													<input class="form-control" name="phone" type="number"
														placeholder="Enter Phone no">
												</div>
												<div class="form-group">
													<label>Password</label>
													<input class="form-control" name="pass" type="password"
														placeholder="Password">
												</div>
												<!-- <div class="form-group">
													<label>Confirm Password</label>
													<input class="form-control" name="acpass" type="password"
														placeholder="Confirm Password">
												</div> -->
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary"
														data-dismiss="modal">Cancel</button>
													<input type="submit" name="insert" class="btn btn-primary"
														value="Submit">
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php
						include ("config.php");
						$error = "";
						$msg = "";
						if (isset($_REQUEST['insert'])) {
							$name = $_REQUEST['name'];
							$email = $_REQUEST['email'];
							$pass = $_REQUEST['pass'];
							$dob = $_REQUEST['dob'];
							$phone = $_REQUEST['phone'];

							if (!empty($name) && !empty($email) && !empty($pass) && !empty($dob) && !empty($phone)) {
								$sql = "insert into admin (auser,aemail,apass,adob,aphone) values('$name','$email','$pass','$dob','$phone')";
								$result = mysqli_query($con, $sql);
								if ($result) {
									$msg = 'Admin Register Successfully';


								} else {
									$error = '* Not Register Admin Try Again';
								}
							} else {
								$error = "* Please Fill all the Fields!";
							}


						}
						?>



						<div class="card-body">

							<table id="basic-datatable" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Email</th>
										<th>Password</th>
										<th>Date Of Birth</th>
										<th>Contact</th>
										<th>Action</th>
									</tr>
								</thead>


								<tbody>
									<?php

									$query = mysqli_query($con, "select * from admin");
									$cnt = 1;
									while ($row = mysqli_fetch_row($query)) {
										?>
										<tr>
											<td><?php echo $cnt; ?></td>
											<td><?php echo $row['1']; ?></td>
											<td><?php echo $row['2']; ?></td>
											<td><?php echo $row['3']; ?></td>
											<td><?php echo $row['4']; ?></td>
											<td><?php echo $row['5']; ?></td>
											<td><a href="admindelete.php?id=<?php echo $row['0']; ?>"><button
														class="btn btn-danger">Delete</button></a>
												<!-- <a href="adminupdate.php?id=<?php echo $row['0']; ?>">
													<button class="btn btn-primary">Update</button></a> -->
											</td>
										</tr>
										<?php
										$cnt = $cnt + 1;
									}
									?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- /Main Wrapper -->


	<!-- jQuery -->
	<script src="assets/js/jquery-3.2.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Slimscroll JS -->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<!-- Datatables JS -->
	<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

	<script src="assets/plugins/datatables/dataTables.select.min.js"></script>

	<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
	<script src="assets/plugins/datatables/buttons.flash.min.js"></script>
	<script src="assets/plugins/datatables/buttons.print.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>

</body>

</html>