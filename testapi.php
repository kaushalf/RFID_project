<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php
    if(isset($_GET)){
        
        if(isset($_GET['card_id'])){
            if(isset($_GET['ride_id'])){
                include 'conn.php';
                $card_id = trim(addslashes($_GET['card_id']));
                $ride_id = trim(addslashes($_GET['ride_id']));
                $check_card_sql = mysqli_query($conn, "SELECT * FROM `card_master` WHERE card_number='$card_id' ");
                
                if(mysqli_num_rows($check_card_sql) > 0){
                    $check_ride_sql = mysqli_query($conn, "SELECT * FROM `ride_master` WHERE machin_id='$ride_id' ");
                    if(mysqli_num_rows($check_ride_sql) > 0){
                        
                        $riderow = mysqli_fetch_assoc($check_ride_sql);
                        $ride_id_ = $riderow['ride_id'];
                        
                        $cardrow = mysqli_fetch_assoc($check_card_sql);
                        $card_id_ = $cardrow['card_id'];
                        
                        $check_user_aasigned = mysqli_query($conn, "SELECT * FROM `transaction` WHERE card_id='$card_id_' AND closeing_date='0000-00-00' ");
                        if(mysqli_num_rows($check_user_aasigned) > 0){
                            $check_history_sql = mysqli_query($conn, "SELECT * FROM `history` WHERE Machine_id='$card_id_' AND close_date='0000-00-00' ");
                            if(mysqli_num_rows($check_history_sql) > 0){
                                $check_history_row = mysqli_fetch_assoc($check_history_sql);
                                $current_amount_ = $check_history_row['current'];
                                $user_main_id = $check_history_row['id'];
                                $ride_price_ = $riderow['current'];
                                if($current_amount_ > 0){
                                    if($current_amount_ > $ride_price_){
                                        $famount = $current_amount_ - $ride_price_;
                                        if(mysqli_query($conn, "UPDATE `history` SET `ride_id`='$ride_id_',`dabite`='$famount',`current`='$famount' WHERE id='$user_main_id' ")){
                                            
                                        }else{
                                            
                                        }
                                    }else{
                                        
                                    }
                                }else{
                                    
                                }
                            }else{
                                
                            }
                        }else{
                            
                        }
                        
                    }else{
                        
                    }
                }else{
                    
                }
            }else{
                
            }
        }else{
            
        }
    }else{
        
    }

?>
<?php
}
else
{
    header("Location: index.php?error=Login again");
}
?>