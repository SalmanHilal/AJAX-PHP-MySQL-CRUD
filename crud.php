<?php
include_once 'connection.php';
session_start();
extract($_POST);
// Change User Cover
if(isset($_FILES["mycover"])){
$uemail = $_SESSION['useremail'];
$username = substr($uemail, 0, strpos($uemail, '@'));
$randomNO = rand(10,100);
$target_dir = "uploads/";
$imageName = $username."-".$randomNO."-".basename($_FILES['mycover']['name'],PATHINFO_EXTENSION);
$target_file = $target_dir . $imageName;
$basename = basename($_FILES["mycover"]["name"]);
$ifimage = ""; 
	if(@exif_imagetype($basename)){ $ifimage = "false";}else{ $ifimage = "true";}	
	if($ifimage == "true"){
		if(file_exists($target_file)){
			echo "File already exits, Please try with different file.";
		}elseif(move_uploaded_file($_FILES["mycover"]["tmp_name"], $target_file)){
		$q = "UPDATE `usersinfo` SET `coverPic`='$target_file' WHERE email='$uemail'";
		mysqli_query($conn,$q);
		echo "Cover pic updated!";
	    }else
	    { echo "Sorry, there was an error uploading your file.";}
	} else {
		echo "Sorry, there was an error uploading your file.";
	}	
}
// Change User Img
if(isset($_FILES["myimg"])){
$uemail = $_SESSION['useremail'];
$username = substr($uemail, 0, strpos($uemail, '@'));
$randomNO = rand(10,100);
$target_dir = "uploads/";
$imageName = $username."-".$randomNO."-".basename($_FILES['myimg']['name'],PATHINFO_EXTENSION);
$target_file = $target_dir . $imageName;
$basename = basename($_FILES["myimg"]["name"]);
$ifimage = ""; 
	if(@exif_imagetype($basename)){ $ifimage = "false";}else{ $ifimage = "true";}	
	if($ifimage == "true"){
		if(file_exists($target_file)){
			echo "File already exits, Please try with different file.";
		}elseif(move_uploaded_file($_FILES["myimg"]["tmp_name"], $target_file)){
		$q = "UPDATE `usersinfo` SET `imgpath`='$target_file' WHERE email='$uemail'";
		mysqli_query($conn,$q);
		echo "Profile pic updated!";
	    }else
	    { echo "Sorry, there was an error uploading your file.";}
	} else {
		echo "Sorry, there was an error uploading your file.";
	}	
}
// isOnline
if(isset($_POST['isOnline'])){
$uemail = $_SESSION['useremail'];
$qonline = "SELECT * FROM usersinfo WHERE isonline = 'true' AND email!='$uemail'";
    if (!$resultonline = mysqli_query($conn,$qonline)) {
        exit(mysqli_error());
    }
    $responseonline = array();
 if(mysqli_num_rows($resultonline) > 0) {
        while ($row = mysqli_fetch_assoc($resultonline)) { 
            $onlineuserName = $row['userName'];
           $onlineimgpath = $row['imgpath'];
          echo  '<li><a href="#" title="'.$onlineuserName.'"><img src="'.$onlineimgpath.'" alt="'.$onlineuserName.'" class="img-responsive profile-photo" /><span class="online-dot"></span></a></li>';
         }
    }
}
// Check Username
if(isset($_POST['checkuserName'])){
	unset($_SESSION["vuserName"]);
	$username = mysqli_real_escape_string($conn,$_POST['checkuserName']);
		if (!empty($username)){
		$username_query = mysqli_query($conn,"SELECT * FROM usersinfo WHERE userName ='$username'");
	    $count=mysqli_num_rows( $username_query);
	    if($count==0) { echo "Username available."; 
	    $_SESSION["vuserName"] = "ok"; exit;
	    }else{ echo "Username already exists!"; exit;}
    }
}
// Check Email
if(isset($_POST['checkemail'])){
	unset($_SESSION["vEmail"]);
	$email = mysqli_real_escape_string($conn,$_POST['checkemail']);
		if (!empty($email)){
		$email_query = mysqli_query($conn,"SELECT * FROM usersinfo WHERE email ='$email'");
	    $count=mysqli_num_rows( $email_query);
	    if($count==0) { echo "Email available."; 
	    $_SESSION["vEmail"] = "ok"; exit;
	    }else{ echo "Email already exists!"; exit;}
    }
}
// Check Phone
if(isset($_POST['checkphone'])){
	unset($_SESSION["vPhone"]);
	$phone = mysqli_real_escape_string($conn,$_POST['checkphone']);
		if (!empty($phone)){
		$q = mysqli_query($conn,"SELECT * FROM usersinfo WHERE phone ='$phone'");
	    $count=mysqli_num_rows($q);
	    if($count==0) { echo "Phone available."; 
	    $_SESSION["vPhone"] = "ok"; exit;
	    }else{ echo "Phone already exists!"; exit;}
    }
}
// Login User
if(isset($_POST['logemail']) && isset($_POST['logpass'])){
  $uid = mysqli_real_escape_string($conn,$_POST['logemail']);
  $pwd = mysqli_real_escape_string($conn,$_POST['logpass']);
  	
  $sql = "SELECT * FROM usersinfo WHERE email='$uid' AND pass='$pwd'";
  $result = mysqli_query($conn, $sql);
	$q = "UPDATE `usersinfo` SET `isonline`='true' WHERE email='$uid'";
	mysqli_query($conn,$q);
  if ($row = mysqli_fetch_assoc($result)) {
    echo "You are logged in!";
    $_SESSION["useremail"] = "$uid";
  } else {
    echo "Username or password is incorrect!";
  }

}
// Save User
if(isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['pass'])) {
$target_dir = "uploads/";
$imageName = $_POST['userName']."-".basename($_FILES['myfile']['name'],PATHINFO_EXTENSION);
$target_file = $target_dir . $imageName;

if(isset($_SESSION["vuserName"]) && isset($_SESSION["vEmail"]) && isset($_SESSION["vPhone"])){
	if (file_exists($target_file) && @is_array(getimagesize($target_file))) {
	    echo "Sorry, file already exists.";
	}else{
		if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
	    } else { echo "Sorry, there was an error uploading your file.";}

		$q="INSERT INTO `usersinfo`(`userName`, `email`, `phone`, `pass`,`imgpath`) VALUES
		 ('$userName','$email','$phone','$pass','$target_file')";
		if (mysqli_query($conn, $q)) {
		    echo 'User '.$userName.', Added Successfully!';
		} else {
		    echo "Error:<br>" . mysqli_error($conn);
		}
		 mysqli_close($conn);
	}
}else{echo "One of the above fields is empty or invalid! Please check again.";}

}
// All Users
if(isset($_POST['allUsers'])){
	$data =  '<table class="table table-bordered table-striped ">
						<tr class="bg-dark text-white">
							<th>No.</th>
							<th>Profile Pic</th>
							<th>User Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Password </th> 
							<th>Edit </th>
							<th>Delete </th>
						</tr>'; 
	$displayquery = " SELECT * FROM `usersinfo` "; 
	$result = mysqli_query($conn,$displayquery);
	if(mysqli_num_rows($result) > 0){
		$number = 1;
		while ($row = mysqli_fetch_array($result)) {
			
			$data .= '<tr>  
				<td>'.$number.'</td>
				<td class="img"><img src="'.$row['imgpath'].'"></td>
				<td>'.$row['userName'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['phone'].'</td>
				<td>'.str_repeat('*', strlen($row['pass'])).'</td>
				<td>
					<button onclick="editUser('.$row['id'].')" class="btn btn-success">Edit</button>
				</td>
				<td>
					<button onclick="deleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
   		$number++;
		}
	} 
	 $data .= '</table>';
    	echo $data;
}
// All Users PAGE
if(isset($_POST['allUsersphp'])){
	$data =  '<table class="table table-bordered table-striped ">
						<tr class="bg-dark text-white">
							<th>No.</th>
							<th>Profile Pic</th>
							<th>User Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Password </th> 
						</tr>'; 
	$displayquery = " SELECT * FROM `usersinfo` "; 
	$result = mysqli_query($conn,$displayquery);
	if(mysqli_num_rows($result) > 0){
		$number = 1;
		while ($row = mysqli_fetch_array($result)) {
			
			$data .= '<tr>  
				<td>'.$number.'</td>
				<td class="img"><img src="'.$row['imgpath'].'"></td>
				<td>'.$row['userName'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['phone'].'</td>
				<td>'.str_repeat('*', strlen($row['pass'])).'</td>
    		</tr>';
   		$number++;
		}
	} 
	 $data .= '</table>';
    	echo $data;
}
// Delete User
if(isset($_POST['userID'])){
	$q="DELETE FROM `usersinfo` WHERE id=$userID";
	$quser="SELECT * FROM `usersinfo` WHERE id=$userID;";
	mysqli_query($conn,$q);
	echo 'User Deleted Successfully!';
}
// Get User Data
if(isset($_POST['uid']) && isset($_POST['uid']) != ""){
    $user_id = $_POST['uid'];
    $query = "SELECT * FROM usersinfo WHERE id = '$user_id'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }
    $response = array();
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;}
    }else{
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
    echo json_encode($response);
}else{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}
// Update User
if(isset($_POST['hiddenID'])) {
$hiddenID=$_POST['hiddenID'];
$userName=$_POST['upuserName'];
$email=$_POST['upemail'];
$phone=$_POST['upphone'];
$pass=$_POST['uppassword'];
$target_dir = "uploads/";
$basename = basename($_FILES["myfile"]["name"]);
$target_file = $target_dir.$basename;
$ifimage = ""; 
	if(@exif_imagetype($basename)){ $ifimage = "false";}else{ $ifimage = "true";}	
	if($ifimage == "true"){
		if(file_exists($target_file)){
			echo "File already exits, Please try with different file.";
		}elseif(move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)){
		$q = "UPDATE `usersinfo` SET `userName`='$userName',`email`='$email',`phone`='$phone',`pass`='$pass',`imgpath`='$target_file' WHERE id='$hiddenID'";
		mysqli_query($conn,$q);
		echo "User '$userName' updated successfully!";
	    }else
	    { echo "Sorry, there was an error uploading your file.";}
	} else {
		$q = "UPDATE `usersinfo` SET `userName`='$userName',`email`='$email',`phone`='$phone',`pass`='$pass' WHERE id='$hiddenID'";
		mysqli_query($conn,$q);
		echo "User '$userName' updated successfully!";
	}
}