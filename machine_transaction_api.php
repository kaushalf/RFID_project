<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    if(isset($_POST, $_POST['user_name'])){
        
        include 'conn.php';
        
        $trans = trim(addslashes($_POST['user_name']));
		$array = explode(',',$trans);
		if(count($array) > 0){
			
			$machineid = trim($array[0]);
			$cardnumber = trim($array[1]);
			if(isset($array[2])){
			    $machine_value = trim($array[2]);   
			}else{
			    $machine_value = 1;
			}
			
			if($machine_value > 0){
			    
			    
			    
			}else{
			    
			    echo "Invalid Value Entered";
			    exit;
			    
			}

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
    					echo "Invalid Card";
    					exit;
    					
    				}
    				
    				$checkcard = mysqli_query($conn,"SELECT * FROM `transaction` where card_id = '".$cardid."' AND closeing_date = '0000-00-00 00:00:00'");
    				if(mysqli_num_rows($checkcard) > 0){
    					
    					$crow = mysqli_fetch_assoc($checkcard);
    					
    					$balance = mysqli_query($conn,"select * from history where user_id = '".$crow['user_id']."' AND Machine_id = '".$cardid."' AND history_id = '".$crow['id']."' ORDER BY id DESC LIMIT 1");
    					if(mysqli_num_rows($balance) > 0){
    						
    						$brow = mysqli_fetch_assoc($balance);
    						if($brow['current'] >= $ride_cost){
    							
    							$remain = $brow['current'] - $ride_cost;
    							mysqli_query($conn,"INSERT INTO `history`(`id`, `user_id`, `ride_id`, `Machine_id`, `date_time`, `close_date`, `dabite`, `cradit`, `current`, `history_id`) VALUES ('', '".$crow['user_id']."', '".$mrow['ride_id']."', '$cardid', '".date('Y-m-d H:i:s')."', '0000-00-00', '".$mrow['ride_cost']."', '0', '".$remain."', '".$crow['id']."')");
    							
    							echo "CB - ".$brow['current'].", DR - ".$ride_cost.", RB - $remain, ";
    							echo "Successfully";
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
    					
    				}
    			}else{
    				
    				echo "Invalid machineid";
    				
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
    					echo "Invalid Card";
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
    							    
    							    $remain = $brow['current'] - $machine_value;
        							mysqli_query($conn,"INSERT INTO `history`(`id`, `user_id`, `ride_id`, `Machine_id`, `date_time`, `close_date`, `dabite`, `cradit`, `current`, `history_id`) VALUES ('', '".$crow['user_id']."', '".$mrow['ride_id']."', '$cardid', '".date('Y-m-d H:i:s')."', '0000-00-00', '".$mrow['ride_cost']."', '0', '".$remain."', '".$crow['id']."')");
        							
        							echo "CB - ".$brow['current'].", \n DR - ".$machine_value.",\n RB - $remain, ";
									
        							echo "Successfully";
    							    
    							}else{
    							    
    							    echo "Invalid Value Entered";
    							    exit;
    							    
    							}
    							
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
    					
    				}
    			}else{
    				
    				echo "Invalid machineid";
    				
    			}
            }else{
                echo 'Machine TYPE Not Found';
            }
		}else{
			
			echo "Parameter not set";
			
		}
	   
    }else{
        echo 'post par err';
    }
?>
<?php
}
else
{
    header("Location: index.php?error=Login again");
}
?>