<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    if(isset($_POST)){
        
        include 'conn.php';
        
        $trans = trim(addslashes($_POST['user_name']));
		$array = explode(',',$trans);
		if(count($array) == 2){
			
			$machineid = trim($array[0]);
			$cardnumber = trim($array[1]);
			
			
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
					echo "Invalid Card";
					echo $cardnumber;
					exit;
					
				}
				
				$checkcard = mysqli_query($conn,"SELECT * FROM `transaction` where card_id = '".$cardid."' AND closeing_date = '0000-00-00 00:00:00'");
				if(mysqli_num_rows($checkcard) > 0){
					
					$crow = mysqli_fetch_assoc($checkcard);
					
					$balance = mysqli_query($conn,"select * from history where user_id = '".$crow['user_id']."' AND Machine_id = '".$cardid."' AND history_id = '".$crow['id']."' ORDER BY id DESC LIMIT 1");
					if(mysqli_num_rows($balance) > 0){
						
						$brow = mysqli_fetch_assoc($balance);
						if($brow['current'] >= $mrow['ride_cost']){
							
							$remain = $brow['current'] - $mrow['ride_cost'];
							mysqli_query($conn,"INSERT INTO `history`(`id`, `user_id`, `ride_id`, `Machine_id`, `date_time`, `close_date`, `dabite`, `cradit`, `current`, `history_id`) VALUES ('', '".$crow['user_id']."', '".$mrow['ride_id']."', '$cardid', '".date('Y-m-d H:i:s')."', '0000-00-00', '".$mrow['ride_cost']."', '0', '".$remain."', '".$crow['id']."')");
							
							echo "Current Balance - ".$brow['current'].",\nRide_cost - ".$mrow['ride_cost'].",\nRemain - $remain ";
							echo "\nTransaction Made Successfully";
						}else{
							
							echo "insufficient balance";
							
						}
						
					}else{
						
						
						echo "Balance not Available";
						
					}
					
					
				}else{
					
					$newcardsql = mysqli_query($conn, "SELECT * FROM `newCard` WHERE card_num='$cardnumber' ");
					if(!mysqli_num_rows($newcardsql) > 0){
					    mysqli_query($conn, "INSERT INTO `newCard`(`id`, `card_num`) VALUES ('', '$cardnumber')");   
					}
					echo "Invalid Card";
					echo $cardnumber;
					
				}
			}else{
				
				echo "Invalid machineid";
				
			}
		}else{
			
			echo "Parameter not set";
			
		}
	  
	   
    }

?>
<?php
}
else
{
    header("Location: index.php?error=Login again");
}
?>