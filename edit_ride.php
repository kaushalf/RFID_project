<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php
    if(isset($_REQUEST['ed_ride'])){
        include 'conn.php';
        $suprd_id = base64_decode(base64_decode($_REQUEST['rd_id']));
        $check_ride_id_sql = mysqli_query($conn, "SELECT * FROM `ride_master` WHERE ride_id='$suprd_id' ");
        if(mysqli_num_rows($check_ride_id_sql) > 0){
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
	</style>
</head>
        <body>
        <?php
			//include 'left-nav.php';
			include 'top-nav.php';
		?>
        <div class="container mt-5">
            <div class="row">
        					<div class="col-xl-11 mx-auto">
        						<hr>
        						<div class="card border-top border-0 border-4">
        							<div class="card-body p-5">
        								<div class="card-title d-flex align-items-center">
        									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
        									</div>
        									<h5 class="mb-0 text-primary">Edit Ride</h5>
        								</div>
        								<hr>
        								<?php
        								    $rd_id = base64_decode(base64_decode($_REQUEST['rd_id']));
                                            $ride_req_sql = mysqli_query($conn, "SELECT * FROM `ride_master` WHERE ride_id='$rd_id' ");
                                            $ride_req_row = mysqli_fetch_assoc($ride_req_sql);
        								?>
        								<form action="editridepost.php" method="post" enctype="multipart/form-data" class="row g-3">
        									<div class="col-md-6">
        										<label class="form-label">Ride Name</label>
        										<input type="text" class="form-control" name="ride_name" value="<?=$ride_req_row['ride_name'];?>">
        										<input type="hidden" name="ride_id" value="<?=$ride_req_row['ride_id'];?>" />
        										<input type="hidden" name="ridemaster" value="ridemaster" />
        									</div>
        									<div class="col-md-6">
        										<label class="form-label">Edit Ride Cost</label>
        										<input type="number" class="form-control" id="ridecost" min="0" name="ride_cost" value="<?=$ride_req_row['ride_cost'];?>">
        									</div>
        									<div class="col-md-6">
        										<label class="form-label">Edit Machin ID</label>
        										<input type="text" class="form-control" name="machin_id" value="<?=$ride_req_row['machin_id'];?>">
        									</div>
        									<div class="col-md-6">
        										<label class="form-label">Edit Ride SEAT</label>
        										<input type="text" class="form-control" id="rideseat" min="0" name="total_seat" value="<?=$ride_req_row['ride_sheet'];?>">
        									</div>
        									<div class="col-12">
        										<label class="form-label">Ride Description</label>
        										<textarea class="form-control" id="ridedecription" name="ride_desc" rows="3"><?=$ride_req_row['ride_description'];?></textarea>
        									</div>
        									<div class="col-12">
        										<label class="form-label">Ride Description (Optional)</label>
        										<input type="file" name="fileToUpload" id="fileToUpload" class="form-control" />
        									</div>
        									<div class="col-md-6">
        										<label class="form-label">Children Capacity</label>
        										<input type="number" class="form-control" id="childrencapacity" min="0" name="children_capacity" placeholder="5" value="<?=$ride_req_row['children'];?>">
        									</div>
        									<div class="col-md-6">
        										<label class="form-label">Adult Capacity</label>
        										<input type="number" class="form-control" id="adultcapacity" min="0" name="adult_capacity" placeholder="6" value="<?=$ride_req_row['adult'];?>">
        									</div>
        									<div class="col-12">
        										<input type="submit" value="Edit Ride" name="submit" class="btn btn-primary px-5" />
        										<button type="button" onclick="cancel()" class="btn btn-danger px-5">Cancel</button>

        									</div>
											
        								</form>
        							</div>
        						</div>
        					</div>
        				</div>
    </div>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js">
	</script>
	<script>
	function cancel() {
        if (confirm("Are you sure you want to cancel?")) {
            window.location.href = 'ridemaster.php';
        }
        else {
            window.history.pushState(null, null, window.location.href);
        }
    }

    window.onpopstate = function(event) {
        if (event.state === null) {
            window.history.pushState(null, null, window.location.href);
        }
    };

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
        }else{
             header('Location: tmp.php');
            exit;
        }
    }else{
        header('Location: tmp.php');
        exit;
    }
?>
<?php
}
else
{
    header("Location: index.php?error=Login again");
}
?>