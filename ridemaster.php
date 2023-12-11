<?php
session_start();
if(isset($_SESSION['id'])){
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<link rel="stylesheet" href="assets/css/semi-dark.css" />
	<link rel="stylesheet" href="assets/css/header-colors.css" />
	<title>MYpayMent</title>
	<style>
	    .ride_img{
	        height:70px;
	    }
		input[type=text] {
      text-transform: capitalize;
    }
	</style>
</head>

<body>
	<!--wrapper-->
	<div class="container">
	<?php
			//include 'left-nav.php';
			include 'top-nav.php';
			include 'conn.php';
			
			// if delete button is clicked
			if(isset($_GET['delete_id'])){
				$ride_id = base64_decode(base64_decode($_GET['delete_id']));
				// delete ride from the database
				$delete_ride = mysqli_query($conn, "DELETE FROM `ride_master` WHERE `ride_id`='$ride_id'");
			}
		?>
		<!--start page wrapper -->
		<div class="container">
			
			<div class="container m-5">
				<!--breadcrumb-->
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-11 mx-auto">
						<h6 class="mb-0 text-uppercase m-5">All Ride Details</h6>
						<hr/>
						<div class="col-12 m-3" >
										<input type="submit" value="Add Ride"onclick="scrollToBottom()"  class="btn btn-primary px-5" />
									</div>
						<div class="card">
							<div class="card-body m-5" >
								
								<table class="table table-bordered mb-0">
									<thead class="table-dark">
										<tr>
											<th scope="col">Ride</th>
											<th scope="col">Ride Name</th>
											<th scope="col">Ride Cost</th>
											<th scope="col">Ride Seats</th>
											<th scope="col">Ride Description</th>
											<th scope="col">Children</th>
											<th scope="col">Adult</th>
											<th scope="col">Machine_id</th>
                                            <th scope="col">Update</th>
                                            <!-- <th scope="col">Delete</th> -->

										</tr>
									</thead>
									<tbody>
									    <?php
									        $sql = mysqli_query($conn, "SELECT * FROM `ride_master` ");
									        $count = 1;
									        while($row = mysqli_fetch_assoc($sql)){
									    ?>
										<tr>
											<th scope="row"><?=$count;?></th>
											<td><?=$row['ride_name'];?></td>
											<td><?=$row['ride_cost'];?></td>
											<td><?=$row['ride_sheet'];?></td>
											<td><?=$row['ride_description'];?></td>
											<td><?=$row['children'];?></td>
											<td><?=$row['adult'];?></td>
											<td><?=$row['machin_id'];?></td>
											<td><a href="edit_ride.php?ed_ride=<?=base64_encode(base64_encode('edit')).'&rd_id='.base64_encode(base64_encode($row['ride_id']));?>">Edit</a></td>
											<!-- <td><a href='?delete_id=$ride_id' class='btn btn-danger' onclick="return confirm('Are you sure you want to delete this ride?');">Delete</a></td> -->
										</tr>
                                        <?php
                                            $count++;
									        }
                                        ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-11 mx-auto">
						<hr>
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Add New Ride.</h5>
								</div>
								<hr>
								<form action="addride.php" method="post" enctype="multipart/form-data" class="row g-3">
									<div class="col-md-6">
										<label for="ridename" class="form-label">Ride Name</label>
										<input type="text" class="form-control" name="ride_name" placeholder="Ride Name" id="ridename">
										<input type="hidden" name="ridemaster" value="ridemaster" />
									</div>
									<div class="col-md-6">
										<label for="ridecost" class="form-label">Add Ride Cost</label>
										<input type="number" class="form-control" name="ride_cost" placeholder="00" id="ridecost" min="0">
									</div>
									<div class="col-md-6">
										<label for="machin_id" class="form-label">Add Machin ID</label>
										<input type="text" class="form-control" name="machin_id" placeholder="Exp-2e" id="machin_id">
									</div>
									<div class="col-md-6">
										<label for="rideseat" class="form-label">Add SEAT</label>
										<input type="number" class="form-control" name="total_seat" placeholder="4 or 5 Seats" id="rideseat" min="0">
									</div>
									<div class="col-12">
										<label for="ridedecription" class="form-label">Ride Description</label>
										<textarea class="form-control" id="ridedecription" name="ride_desc" placeholder="Default Ride Description" rows="3"></textarea>
									</div>
									<div class="col-12">
										<label class="form-label">Ride Description (Optional)</label>
										<input type="file" name="fileToUpload" id="fileToUpload" class="form-control" />
									</div>
									<div class="col-md-6">
										<label for="childrencapacity" class="form-label">Children Capacity</label>
										<input type="number" class="form-control" name="children_capacity" placeholder="5" id="childrencapacity" min="0">
									</div>
									<div class="col-md-6">
										<label for="adultcapacity" class="form-label">Adult Capacity</label>
										<input type="number" class="form-control" name="adult_capacity" placeholder="6" id="adultcapacity" min="0">
									</div>
									<div class="col-12">
										<input type="submit" value="Add Ride" name="submit" class="btn btn-primary px-5" />
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr/>
			<h6 class="mb-0">Theme Styles</h6>
			<hr/>
			<div class="d-flex align-items-center justify-content-between">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
					<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
					<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
					<label class="form-check-label" for="semidark">Semi Dark</label>
				</div>
			</div>
			<hr/>
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr/>
			<h6 class="mb-0">Header Colors</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator headercolor1" id="headercolor1"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor2" id="headercolor2"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor3" id="headercolor3"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor4" id="headercolor4"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor5" id="headercolor5"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor6" id="headercolor6"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor7" id="headercolor7"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor8" id="headercolor8"></div>
					</div>
				</div>
			</div>
			<hr/>
			<h6 class="mb-0">Sidebar Colors</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
	<script>
	    console.log(btoa('ed_ride'));
		
    function scrollToBottom() {
        window.scrollTo(0, document.body.scrollHeight);
    }
	var depositInput = document.getElementById("ridecost");
        depositInput.addEventListener("input", function() {
        if (this.value < 0) {
            alert("Please enter a positive value.");
            this.value = 0;
        }
    });

	var depositInput = document.getElementById("rideseat");
        depositInput.addEventListener("input", function() {
        if (this.value < 0) {
            alert("Please enter a positive value.");
            this.value = 0;
        }
    });

	var depositInput = document.getElementById("childrencapacity");
        depositInput.addEventListener("input", function() {
        if (this.value < 0) {
            alert("Please enter a positive value.");
            this.value = 0;
        }
    });

	var depositInput = document.getElementById("adultcapacity");
        depositInput.addEventListener("input", function() {
        if (this.value < 0) {
            alert("Please enter a positive value.");
            this.value = 0;
        }
    });
</script>
	
</body>

</html>
<?php
}
else
{
    header("Location: index.php?error=Login again");
}
?>