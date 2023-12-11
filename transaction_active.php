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
	<title>MypayMent</title>
	<style>
	    .ride_img{
	        height:70px;
	    }
	</style>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<?php
			//include 'left-nav.php';
			include 'top-nav.php';
			include 'conn.php';
			
			
			
function get_one_record($table,$field,$value){
	
	global $conn;
	$sql = mysqli_query($conn,"select * from $table where BINARY $field = BINARY '$value'");
	$row = mysqli_fetch_assoc($sql);
	return $row;
	
}


		?>
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Masters</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Card Master</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-11 mx-auto">
						<h6 class="mb-0 text-uppercase">All Card Details</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<table class="table table-bordered mb-0">
									<thead class="table-dark">
										<tr>
											<th scope="col">Number</th>
											<th scope="col">Ride</th>
											<th scope="col">Ride Name</th>
											<th scope="col">Date</th>
											<th scope="col">Minus</th>
											<th scope="col">Add</th>
											<th scope="col">Closing</th>
											
										</tr>
									</thead>
									<tbody>
									    <?php
									        $sql = mysqli_query($conn, "SELECT * FROM `history` where history_id = '".$_REQUEST['id']."'");
									        $count = 1;
									        while($row = mysqli_fetch_assoc($sql)){
												$ride = get_one_record('ride_master','ride_id',$row['ride_id']);
												
									    ?>
										<tr>
											<th scope="row"><?=$count;?></th>
											<td><?=$ride['machin_id'];?></td>
											<td><?=$ride['ride_name'];?></td>
											<td><?=date('d-m-Y H:i:s',strtotime($row['date_time']));?></td>
											<td><?=$row['dabite'];?></td>
											<td><?=$row['cradit'];?></td>
											<td><?=$row['current'];?></td>
											
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
		
		function closecard(trans){
			
			
			$.ajax({
				url: 'closecard_ajax.php',
				type: 'post',
				data: {
					trans:trans
				},
				success: function(data){
					alert(data);
					location.reload();
				},
				error: function(data){
					alert("Some Error Try Again! " + data);
				},
			});
			
		}
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