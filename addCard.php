<?php
session_start();
if(isset($_SESSION['id'])){
?><?php
    $referr = array(1 => "referer error. ", 2 => "host error. ", 3 => "file error ", 4 => "dataType error. ", 5 => "subDataType error. ");
    function err($referr, $arrayKey){
        echo "There Are Some Error. Please Try Again. ".$referr[$arrayKey];   
    }
    
    if(isset($_SERVER['HTTP_REFERER'])){
		$url_parse = parse_url($_SERVER['HTTP_REFERER']);
            if(strpos($url_parse['path'], 'newCard.php') !== false){
                require_once('conn.php');
                if(isset($_POST)){
                    if(isset($_POST['type'])){
                        $type = trim(addslashes($_POST['type']));
                        if($type == "addCard"){
                            $card = trim(addslashes($_POST['cardnum']));
                            if(is_numeric($card)){
                                $checkSql = mysqli_query($conn, "SELECT * FROM `card_master` WHERE card_number='$card' ");
                                if(mysqli_num_rows($checkSql) > 0){
                                    echo "Card is Exist";
                                }else{
                                    mysqli_query($conn, "INSERT INTO `card_master`(`card_id`, `card_number`) VALUES ('', '$card')");
                                    mysqli_query($conn, "DELETE FROM `newCard` WHERE card_num='$card' ");
                                    echo "success new card is inserted.";
                                }
                            }else{
                                echo "Number Format Not Valid.";
                            }
                        }elseif($type == "removeCard"){
                            $card = trim(addslashes($_POST['cardNum']));
                            $checksql = mysqli_query($conn, "SELECT * FROM `newCard` WHERE card_num='$card' ");
                            if(mysqli_num_rows($checksql) > 0){
                                mysqli_query($conn, "DELETE FROM `newCard` WHERE card_num='$card' ");
                                echo "card removed successfully.";
                            }else{
                                echo "Card is Not Available.";
                            }
                        }else{
                            err($referr, 5);
                        }
                    }else{
                        err($referr, 4);
                    }
                }else{
                    err($referr, 4);
                }
            }else{
                err($referr, 3);
            }
    }else{
        err($referr, 1);
    }
?>
<?php
}
else
{
    header("Location: index.php?error=Login again");
}
?>