<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    if(isset($_POST)){
        
        include 'conn.php';
        
        $trans = trim(addslashes($_POST['trans']));
       
	   $sql = mysqli_query($conn,"select * from transaction where id = '$trans' AND closeing_date = '0000-00-00'");
	   if(mysqli_num_rows($sql) > 0){
		   
		   $row = mysqli_fetch_assoc($sql);
		   
		   $lastid = mysqli_query($conn,"select * from history where user_id = '".$row['user_id']."' AND history_id = '".$row['id']."' AND Machine_id = '".$row['card_id']."' ORDER BY id DESC LIMIT 1");
		   
		   $lrow = mysqli_fetch_assoc($lastid);
		   $lastamount = $lrow['current'];
		   
		   mysqli_query($conn,"INSERT INTO `history`(`id`, `user_id`, `ride_id`, `Machine_id`, `date_time`, `close_date`, `dabite`, `cradit`, `current`, `history_id`) VALUES ('', '".$row['user_id']."', '0', '".$row['card_id']."', '".date('Y-m-d H:i:s')."', '0000-00-00', '$lastamount', '0', '0', '$trans')");
		   
		   mysqli_query($conn,"update transaction set closeing_date = '".date('Y-m-d H:i:s')."',remaining_amount = '$lastamount' where id = '$trans'");
		   
		   echo "Closed Successfully";
		   
	   }else{
		   
		   echo "Invalid Request";
		   
		   
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