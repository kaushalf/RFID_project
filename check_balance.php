<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php
    include 'conn.php';
    if ( isset($_GET['card'], $_GET) ) {
        
        $card = trim(addslashes($_GET['card']));
        
        $checkCardSql = mysqli_query($conn, "SELECT * FROM `card_master` WHERE card_number='$card' ");

        if ( mysqli_num_rows($checkCardSql) > 0 ) {
            
            $sqlMaster = mysqli_fetch_assoc($checkCardSql);
            
            $cardNum = trim(addslashes($sqlMaster['card_id']));
            
            $sql = mysqli_query($conn, "SELECT * FROM `transaction` WHERE card_id = '$cardNum' AND closeing_date = '0000-00-00 00:00:00'");

            if (mysqli_num_rows($sql) > 0) {
                
                $row = mysqli_fetch_assoc($sql);
                $diposite_amount = trim($row['diposite_amount']);
                $remening_amount = trim($row['remaining_amount']);
                $famount = $diposite_amount - $remening_amount;
                $arr = ["status" => "Your Remaining Balance is $famount"];
                
                echo json_encode($arr);
                
            } else {
                $arr = ["status" => "Invalid Card Number"];
                echo json_encode($arr);
            }
            
        } else {
            $arr = ["status" => "Invalid Card Number"];
            echo json_encode($arr);
        }
            
    } else {
        $arr = ["status" => "Invalid Card Number"];
        echo json_encode($arr); 
    };
?>
<?php
}
else
{
    header("Location: index.php?error=Login again");
}
?>