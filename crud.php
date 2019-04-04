<?php
include_once 'connection.php';

extract($_POST);
// Save User
if(isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['pass'])) {
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
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