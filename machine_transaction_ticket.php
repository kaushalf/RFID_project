<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    if(isset($_GET['machineid'], $_GET['cardnumber'], $_GET['machine_value'])){
        
        include 'conn.php';
		
		$machineid = trim(addslashes($_GET['machineid']));
		
		$cardnumber = trim(addslashes($_GET['cardnumber']));
		
		$machine_value = trim(addslashes($_GET['machine_value']));
		
		$machineCheck = substr($machineid,0,3);
		
		 if($machineCheck == "GMM"){
			$sql = mysqli_query($conn,"select * from ride_master where machin_id = '$machineid'");
			if(mysqli_num_rows($sql) > 0){
				
				$mrow = mysqli_fetch_assoc($sql);
				$ride_cost = $mrow['ride_cost'] * $machine_value;
				$cardq = mysqli_query($conn,"select * from card_master where card_number = '$cardnumber'");
				if(mysqli_num_rows($cardq) > 0){
					
					$cardrow = mysqli_fetch_assoc($cardq);
					$cardid = $cardrow['card_id'];
					
					
				}else{
					
					$newcardsql = mysqli_query($conn, "SELECT * FROM `newCard` WHERE card_num='$cardnumber' ");
					if(!mysqli_num_rows($newcardsql) > 0){
						mysqli_query($conn, "INSERT INTO `newCard`(`id`, `card_num`) VALUES ('', '$cardnumber')");   
					}
					$array = array("status"=>0,"message"=>"New card added");
					echo json_encode($array);
					exit;
					
				}
				
				$checkcard = mysqli_query($conn,"SELECT * FROM `transaction` where card_id = '".$cardid."' AND closeing_date = '0000-00-00 00:00:00'");
				if(mysqli_num_rows($checkcard) > 0){
					
					$crow = mysqli_fetch_assoc($checkcard);
					
					$balance = mysqli_query($conn,"select * from history where user_id = '".$crow['user_id']."' AND Machine_id = '".$cardid."' AND history_id = '".$crow['id']."' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($balance) > 0){
						
						$brow = mysqli_fetch_assoc($balance);
						if($brow['current'] >= $ride_cost){
							$ticket = time().rand(111,999);
							
							mysqli_query($conn,"INSERT INTO `ticket_generate`(`user_id`, `ride_id`, `Machine_id`, `date_time`, `current`, `history_id`, `ticketnumber`) VALUES ('".$crow['user_id']."', '".$mrow['ride_id']."', '$cardid', '".date('Y-m-d H:i:s')."', '$ride_cost', '".$crow['id']."', '$ticket')");
							
							$array = array("status"=>1,"message"=>"$ticket");
							echo json_encode($array);
							exit;
						}else{
							
							$array = array("status"=>0,"message"=>"Insufficient Balance");
							echo json_encode($array);
							exit;
						}
						
					}else{
						
						
						$array = array("status"=>0,"message"=>"Balance not available");
						echo json_encode($array);
						exit;
					}
					
					
				}else{
					$newcardsql = mysqli_query($conn, "SELECT * FROM `newCard` WHERE card_num='$cardnumber' ");
					if(!mysqli_num_rows($newcardsql) > 0){
						mysqli_query($conn, "INSERT INTO `newCard`(`id`, `card_num`) VALUES ('', '$cardnumber')");   
					}
					$array = array("status"=>0,"message"=>"New Card Added");
					echo json_encode($array);
					exit;
				}
			}else{
				
				$array = array("status"=>0,"message"=>"Invalid ride id");
				echo json_encode($array);
				exit;
				
			}
		}elseif($machineCheck == "GMH"){
			$sql = mysqli_query($conn,"select * from ride_master where machin_id = '$machineid'");
			if(mysqli_num_rows($sql) > 0){
				
				$mrow = mysqli_fetch_assoc($sql);
				
				$cardq = mysqli_query($conn,"select * from card_master where card_number = '$cardnumber'");
				if(mysqli_num_rows($cardq) > 0){
					
					$cardrow = mysqli_fetch_assoc($cardq);
					$cardid = $cardrow['card_id'];
					
					
				}else{
					
					$newcardsql = mysqli_query($conn, "SELECT * FROM `newCard` WHERE card_num='$cardnumber' ");
					if(!mysqli_num_rows($newcardsql) > 0){
						
						mysqli_query($conn, "INSERT INTO `newCard`(`id`, `card_num`) VALUES ('', '$cardnumber')"); 
						
					}
					
					$array = array("status"=>0,"message"=>"New card added");
					echo json_encode($array);
					exit;
					
				}
				
				$checkcard = mysqli_query($conn,"SELECT * FROM `transaction` where card_id = '".$cardid."' AND closeing_date = '0000-00-00 00:00:00'");
				if(mysqli_num_rows($checkcard) > 0){
					
					$crow = mysqli_fetch_assoc($checkcard);
					
					$balance = mysqli_query($conn,"select * from history where user_id = '".$crow['user_id']."' AND Machine_id = '".$cardid."' AND history_id = '".$crow['id']."' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($balance) > 0){
						
						$brow = mysqli_fetch_assoc($balance);
						if($brow['current'] >= $machine_value){
							if($machine_value > 0){
								
								$ticket = time().rand(111,999);
								$ride_cost = $machine_value;
								mysqli_query($conn,"INSERT INTO `ticket_generate`(`user_id`, `ride_id`, `Machine_id`, `date_time`, `current`, `history_id`, `ticketnumber`) VALUES ('".$crow['user_id']."', '".$mrow['ride_id']."', '$cardid', '".date('Y-m-d H:i:s')."', '$ride_cost', '".$crow['id']."', '$ticket')");
								
								$array = array("status"=>1,"message"=>"$ticket");
								echo json_encode($array);
								exit;
								
							}else{
								
								$array = array("status"=>0,"message"=>"Invalid value given");
								echo json_encode($array);
								exit;
								
							}
							
						}else{
							
							$array = array("status"=>0,"message"=>"Insufficient balance");
							echo json_encode($array);
							exit;
							
						}
						
					}else{
						
						
						$array = array("status"=>0,"message"=>"Balance not available");
						echo json_encode($array);
						exit;
						
					}
					
					
				}else{
					$newcardsql = mysqli_query($conn, "SELECT * FROM `newCard` WHERE card_num='$cardnumber' ");
					if(!mysqli_num_rows($newcardsql) > 0){
						mysqli_query($conn, "INSERT INTO `newCard`(`id`, `card_num`) VALUES ('', '$cardnumber')");   
					}
					$array = array("status"=>0,"message"=>"New card added");
					echo json_encode($array);
					exit;
					
				}
			}else{
				
				$array = array("status"=>0,"message"=>"machine id invalid");
				echo json_encode($array);
				exit;
				
			}
		}else{
			$array = array("status"=>0,"message"=>"Machine type not found");
			echo json_encode($array);
			exit;
		}
	   
    }else{
        $array = array("status"=>0,"message"=>"invalid parameters");
		echo json_encode($array);
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