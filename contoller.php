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
	<style>
	    .ride_img{
	        height:70px;
	    }
		input[type=text] {
      text-transform: capitalize;
    }


	</style>
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
	<!--wrapper-->
	<div class="container">
		<?php
			// include 'left-nav.php';
			 include 'top-nav.php';
			 include 'conn.php';
		?>
		<!--start page wrapper -->
		<div class="container my-10">
			<div class="page-content">
				<!--breadcrumb-->
					<!-- <div class="breadcrumb-title pe-3">Masters</div> -->
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-5">
							</ol>
						</nav>
					</div>
					
				</div>
				<div class="row mb-5">
					
						<hr>
						<div class="card border-top border-0 border-4 ">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Assign User To Card.</h5>
								</div>
								<hr>
								<div class="row g-3">
									<div class="col-md-6">
										<label class="form-label">Full Name</label>
										<input type="text" class="form-control" id="user_name" placeholder="Name">
									</div>
									<div class="col-md-6">
										<label class="form-label">Mobile Number</label>
										<input type="text" class="form-control" id="user_number" placeholder="Number" maxlength="10">
									</div>
									<div class="col-md-6">
										<label class="form-label">City</label>
										<input type="text" class="form-control" id="user_city" placeholder="City">
									</div>

									<!-- <label for="city">Select a city:</label>
									<select id="city" name="city"></select> -->
									
									<div class="col-md-6">
									<label class="form-label">Card Number</label>
									<div class="col-md-6 input-group" style="width: 100%; height: 10%;">
										<input type="password" class="form-control" id="card_number" placeholder="Max 10 Number" maxlength="10" />
										<input type="text" class="form-control" id="card_number1" placeholder="Re-Enter Card Number" maxlength="10" />
									</div>
									</div>
									<div class="col-12">
										<label class="form-label">Deposit Amount</label>
										<input type="number" class="form-control" id="deposit" min="0" placeholder="" />
									</div>
									<div class="col-12">
										<input type="button" value="Assignee Card" id="_assignee_card" name="submit" class="btn btn-primary px-5" />
									</div>
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
	<!-- <div class="switcher-wrapper">
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
	</div> -->
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
	    $(document).ready(function(){
            $('#_assignee_card').click(function(){
                var user_name = $('#user_name').val().trim();
                var user_number = $('#user_number').val().trim();
                var user_city = $('#user_city').val().trim();
                var card_number = $('#card_number').val().trim();
                var card_number1 = $('#card_number1').val().trim();
                var deposit = $('#deposit').val().trim();
				var user_name1 = user_name[0].toUpperCase() + user_name.substring(1);
				var user_city1 = user_city[0].toUpperCase() + user_city.substring(1);


				if(card_number == card_number1){
					$.ajax({
						url: 'assignee.php',
						type: 'post',
						data: {
							user_name: user_name1,
							user_number: user_number,
							user_city: user_city1,
							card_number: card_number,
							deposit: deposit
						},
						success: function(data){
							alert(data);
						},
						error: function(data){
							alert("Some Error Try Again! " + data);
						},
					});
				}else {
					alert("Card number not correct..!");
				}
            });
	    });
		var depositInput = document.getElementById("deposit");
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