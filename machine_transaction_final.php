<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    if(isset($_GET['ticket'])){
        
        include 'conn.php';
        
        // $jsarr = json_decode($_POST['data']);
        
        // $ticket = trim(addslashes($jsarr->ticket));
        
        $ticket = trim(addslashes($_GET['ticket']));
		
		$sql = mysqli_query($conn,"select * from ticket_generate where ticketnumber = '$ticket'");
		
		if(mysqli_num_rows($sql) > 0){
			
			$row = mysqli_fetch_assoc($sql);
			
			$user_id = trim(addslashes($row['user_id']));
			$ride_id = trim(addslashes($row['ride_id']));
			$card_id = trim(addslashes($row['Machine_id']));
			$amount = trim(addslashes($row['current']));
			$history_id = trim(addslashes($row['history_id']));
			
			$checkcard = mysqli_query($conn,"SELECT * FROM `transaction` where card_id = '".$card_id."' AND closeing_date = '0000-00-00 00:00:00'");
			if(mysqli_num_rows($checkcard) > 0){
				
				$crow = mysqli_fetch_assoc($checkcard);
				$balance = mysqli_query($conn,"select * from history where user_id = '".$user_id."' AND Machine_id = '".$card_id."' AND history_id = '".$history_id."' ORDER BY id DESC LIMIT 1");
				if(mysqli_num_rows($balance) > 0){
					
					$brow = mysqli_fetch_assoc($balance);
					if($brow['current'] >= $amount){
						
						$remain = $brow['current'] - $amount;
						mysqli_query($conn,"INSERT INTO `history`(`id`, `user_id`, `ride_id`, `Machine_id`, `date_time`, `close_date`, `dabite`, `cradit`, `current`, `history_id`) VALUES ('', '".$user_id."', '".$ride_id."', '$card_id', '".date('Y-m-d H:i:s')."', '0000-00-00', '".$amount."', '0', '".$remain."', '".$history_id."')");
						
						mysqli_query($conn,"update transaction set remaining_amount = remaining_amount + $amount where id = $history_id");
						mysqli_query($conn,"delete from ticket_generate where id = ".$row['id']."");
						$array = array("status"=>1,"message"=>"Payment done successfully");
						echo json_encode($array);
						exit;
						
					}else{
						
						$array = array("status"=>0,"message"=>"Unsufficient balance");
						echo json_encode($array);
						exit;
						
					}
					
				}else{
					
					
					$array = array("status"=>0,"message"=>"Balance not available");
					echo json_encode($array);
					exit;
					
				}
				
			}else{
				
				
				$array = array("status"=>0,"message"=>"Card not active");
				echo json_encode($array);
				exit;
				
			}

		}else{
			
			$array = array("status"=>0,"message"=>"Ticket not found");
			echo json_encode($array);
			exit;
			
		}
        
    }else{
        $array = array("status"=>0,"message"=>"Parameter not set");
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