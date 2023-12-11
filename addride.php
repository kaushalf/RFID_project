<?php
session_start();
if(isset($_SESSION['id'])){
?>
<?php
    //session cond up
    if(isset($_SERVER['HTTP_REFERER'])){
		$url_parse = parse_url($_SERVER['HTTP_REFERER']);           
            if(strpos($url_parse['path'], 'ridemaster.php') !== false){
                if(isset($_POST['ridemaster'], $_POST)){
                    #conn
                    include 'conn.php';
                    
                    // array of post vars
                    $ride_name = trim(addslashes($_POST['ride_name']));
                    $ride_cost = trim(addslashes($_POST['ride_cost']));
                    $machin_id = trim(addslashes($_POST['machin_id']));
                    $total_seat = trim(addslashes($_POST['total_seat']));
                    $ride_desc = trim(addslashes($_POST['ride_desc']));
                    $children_capacity = trim(addslashes($_POST['children_capacity']));
                    $adult_capacity = trim(addslashes($_POST['adult_capacity']));
                    
                    $postarraySECU = array($ride_name, $ride_cost, $machin_id, $total_seat, $ride_desc, $children_capacity, $adult_capacity);
                    foreach($postarraySECU as $cat){
                        if($cat == null || $cat == '' || strpos($cat, "<") !== false || strpos($cat, ">") !== false || strpos($cat, "^") !== false || strpos($cat, "<>") !== false){
                            $varnotok .= 1;
                        }else{
                            $varnotok .= 0;
                        }
                    }
                    
                    if(strpos($varnotok, '1') !== false){
                        echo "<script type='text/javascript'>alert('Invalid');window.location='tmp.php'</script>";
                    }else{
                        $target_dir = "assets/rideimg/";
                    	$ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                    	$_FILES["fileToUpload"]["name"] = uniqid().".".$ext;
                    	$img = $_FILES["fileToUpload"]["name"];
                    	$target_file = $target_dir . basename($img);
                    	$uploadOk = 1;
                    	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    
                    	// Check if image file is a actual image or fake image
                    	if(isset($_POST["submit"])){
                    	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    	    if($check !== false){
                    		    $uploadOk = 1;
                    	    }else{
                    		    echo "<script type='text/javascript'>alert('File is not an image.'); window.location='tmp.php'</script>";
                    		    $uploadOk = 0;
                    	    }
                    	}
                    
                    	// Allow certain file formats
                    	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
                    	    echo "<script type='text/javascript'>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); window.location='tmp.php'</script>";
                    	    $uploadOk = 0;
                    	}
                    
                    	// Check if $uploadOk is set to 0 by an error
                    	if($uploadOk == 0){
                    	    echo "<script type='text/javascript'>alert('Sorry, your file was not uploaded.'); window.location='tmp.php'</script>";
                    	    // if everything is ok, try to upload file
                    	}else{
                    	    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                    	        $ride_name = trim(addslashes($_POST['ride_name']));
                                $ride_cost = trim(addslashes($_POST['ride_cost']));
                                $machin_id = trim(addslashes($_POST['machin_id']));
                                $total_seat = trim(addslashes($_POST['total_seat']));
                                $ride_desc = trim(addslashes($_POST['ride_desc']));
                                $children_capacity = trim(addslashes($_POST['children_capacity']));
                                $adult_capacity = trim(addslashes($_POST['adult_capacity']));
                    			if(mysqli_query($conn, "INSERT INTO `ride_master`(`ride_id`, `ride_name`, `ride_cost`, `ride_sheet`, `ride_description`, `ride_img`, `children`, `adult`, `machin_id`) VALUES ('', '$ride_name', '$ride_cost', '$total_seat', '$ride_desc', '$img', '$children_capacity', '$adult_capacity', '$machin_id')")){
                    			    echo "<script type='text/javascript'>alert('Ride Added Successfully.'); window.location='ridemaster.php'</script>";
                    			}else{
                    			    echo "<script type='text/javascript'>alert('Invalid Request'); window.location='tmp.php'</script>";
                    			}
                    	    }else{
                    		    echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your file.'); window.location='tmp.php'</script>";
                    	    }
                    	}
                    }
                }else{
                    echo "<script type='text/javascript'>alert('Invalid Request1'); window.location='tmp.php'</script>";
                }
            }else{
                echo "<script type='text/javascript'>alert('Invalid Request2'); window.location='tmp.php'</script>";
            }
    }else{
        echo "<script type='text/javascript'>alert('Invalid Request3'); window.location='tmp.php'</script>";
    }
?>
<?php
}
else
{
    header("Location: tmp.php?error=Login again");
}
?>