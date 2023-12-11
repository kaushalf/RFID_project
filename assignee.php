<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    if(isset($_POST)){
        
        include 'conn.php';
        
        $username = trim(addslashes($_POST['user_name']));
        $usernumber = trim(addslashes($_POST['user_number']));
        $city = trim(addslashes($_POST['user_city']));
        $card_number = trim(addslashes($_POST['card_number']));
        $deposit = trim(addslashes($_POST['deposit']));
        
        

        $c_c_e = mysqli_query($conn, "SELECT * FROM `card_master` WHERE card_number='$card_number' ");
        if(mysqli_num_rows($c_c_e) > 0){
			$c_c_r = mysqli_fetch_assoc($c_c_e);
			$card_id = $c_c_r['card_id'];
			
			
            
            $check_assination = mysqli_query($conn, "SELECT * FROM `transaction` WHERE card_id='$card_id' AND closeing_date='0000-00-00' ");
            
            if(mysqli_num_rows($check_assination) > 0){
                echo "Card is Already Assigned";
            }else{
				
				
				$user_sql = mysqli_query($conn, "INSERT INTO `user_mater`(`user_id`, `user_name`, `user_amount`, `user_number`, `user_city`) VALUES ('', '$username', '', '$usernumber', '$city')");
				$user_id = mysqli_insert_id($conn);
				
				
                if(mysqli_query($conn, "INSERT INTO `transaction`(`id`, `user_id`, `card_id`, `date_open`, `diposite_amount`, `remaining_amount`, `closeing_date`) VALUES ('', '$user_id', '$card_id', '$date', '$deposit', '0', '0000-00-00')")){
					
					$historyid = mysqli_insert_id($conn);
					
                    mysqli_query($conn, "INSERT INTO `history`(`id`, `user_id`, `ride_id`, `Machine_id`, `date_time`, `close_date` , `dabite`, `cradit`, `current`, `history_id`) VALUES ('', '$user_id', '0', '$card_id', '".date('Y-m-d H:i:s')."', '0000-00-00', '0', '$deposit', '$deposit', '$historyid')");
                    echo "Card ($card_number) is Assigned to $username";   
                }else{
                    echo "Error";
                }
            }
        }else{
            echo "Card is Not Registered. ";
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