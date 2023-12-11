
<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php
    include 'conn.php';
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
	<!--wrapper-->
	<div class="contariner">
		<!--sidebar wrapper -->
		<?php
		    //include 'left-nav.php';
		    include 'top-nav.php';
		?>
		<div class="container">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<!-- <div class="breadcrumb-title pe-3">Masters</div>
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
					</div> -->
				</div>
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-11 mx-auto">
						<h6 class="mb-5 text-uppercase">All Card Details</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<table class="table table-bordered mb-0">
									<thead class="table-dark">
										<tr>
											<!-- <th scope="col">Number</th>
											<th scope="col">New Card Number</th>
											<th scope="col">Action</th> -->
									<form action="cardmaster.php" method="POST">
											<div class="col-md-6">
									<label class="form-label">Card Number</label>
									<div class="col-md-6 input-group" style="width: 100%; height: 10%;">
										<input type="password" class="form-control" id="card_number" name ="card_1"placeholder="Max 10 Number" maxlength="10" />
										<!-- <input type="text" class="form-control" id="card_number1" name="card_2" placeholder="Re-Enter Card Number" maxlength="10" /> -->
									</div>
									
									</div>
									<!-- <div class="col-12">
										<label class="form-label">Deposit Amount</label>
										<input type="number" class="form-control" id="deposit" placeholder="" />
									</div> -->
									<div class="col-1 mt-3" >
										<input type="submit" value="Add Card" id="_assignee_card" name="submit" class="btn btn-primary px-5" />
									</div>
									</form>
										</tr>
									</thead>
									<tbody>
									    <?php
										 if(isset($_POST['card_1'])){
											$card_nm = trim(addslashes($_POST['card_1']));
									        $newCsql = mysqli_query($conn, "INSERT into `card_master`(`card_number`) values ($card_nm) ");
											if ($newCsql) {
												$_SESSION['success'] = true;
												echo "<script>localStorage.setItem('successMessageShown', 'true');</script>";
											  }
											
										}
									        // $count = 1;
									        // while($newCrow = mysqli_fetch_assoc($newCsql)){
									    ?>
									    <!-- <tr> -->
											<!-- <th scope="row"><?=$count;?></th> -->
											<!-- <td><?=$newCrow['card_num'];?></td> -->
											<!-- <td>
											    <button class="btn btn-primary addcard" data-card="<?=$newCrow['card_num'];?>">Add Card</button> 
											    <button class="btn btn-danger removecard" data-card="<?=$newCrow['card_num'];?>">Remove Card</button>
											</td> -->
										<!-- </tr> -->
										<!-- <?php
										    // $count++;
									        // }
										?> -->
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
	<!--start switcher-->
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
	    // $(document).ready(function(){
	    //     $('.addcard').each(function(){
	    //         $(this).click(function(){
	    //             var cardNum = $(this).data('card');
	    //             $.ajax({
	    //                 url: 'addCard.php', type: 'post',
	    //                 data: { type: 'addCard', cardnum: cardNum },
	    //                 success: function(req){ alert(req); location.reload(); },
	    //                 error: function(err){ alert("There Are Some Error. Please Try Again"); console.log(err); },
	    //             });
	    //         });
	    //     });
	    //     $('.removecard').each(function(){
	    //         $(this).click(function(){
	    //             if(confirm("Are You Sure You Want To Remove Card")){
	    //                 var cardNum = $(this).data('card');
    	//                 $.ajax({
    	//                     url: 'addCard.php', type: 'post',
    	//                     data: { type: 'removeCard', cardnum: cardNum },
    	//                     success: function(req){ alert(req); location.reload(); },
    	//                     error: function(err){ alert("There Are Some Error. Please Try Again"); console.log(err); },
    	//                 });   
	    //             }
	    //         });
	    //     });
	    // });
		$(document).ready(function() {
		if (localStorage.getItem('successMessageShown') === 'true') {
			alert('Card inserted successfully!');
			localStorage.setItem('successMessageShown', 'false');
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