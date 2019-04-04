<!DOCTYPE html><html><head><title>getogether</title><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="assets/bootstrap.min.css"><script src="assets/jquery.min.js"></script><script src="assets/bootstrap.min.js"></script><link rel="stylesheet" href="assets/style.css"></head><body>
<div class="container"><div class="container-fluid">
<header>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">getogether</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
    </div>
  </div>
</nav>
</header>
<div class="container-fluid">
	<form id="insertDataForm" class="table-bordered" style="padding:15px" enctype="multipart/form-data">
		<h3>Add New User</h3>
		<div class="form-group">
			<label><span>User Name:</span> 
				<input type="text" name="userName" id="userName" placeholder="User Name" class="form-control" required/>
			</label>
		</div>
		<div class="form-group">
			<label><span>Email: </span>
				<input type="email" name="email" id="email" placeholder="Email" class="form-control" required/>
			</label>
		</div>
		<div class="form-group">
			<label><span>Phone: </span>
				<input type="text" name="phone" id="phone" placeholder="Phone" class="form-control" required/>
			</label>
		</div>
		<div class="form-group">
			<label><span>Password:</span> 
				<input type="password" name="pass" id="pass" placeholder="Password" class="form-control" required/>
			</label>
		</div>
		<div class="form-group">
			<label>Profile Pic:
				<input type="file" name="myfile" id="myfile" class="form-control">
			</label>
		</div>
		 <input type="button" class="btn btn-primary btnc" onclick="insertData()" value="Add User"/>
	</form>
</div></div>
<div class="container-fluid">
<h3>All Users</h3>
	<div id="allUsers">
	</div>	
</div>
</div><!-- COntent ENd-->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form id="updateDataForm"  enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit User Details</h4>
      </div>
      <div class="modal-body">    	
      	<div class="text-center">
      	      	<img src="" id="pp" height="110px">	
      	</div>
		<div class="form-group">
			<label>User Name: 
				<input type="text" name="upuserName" id="up_userName" placeholder="User Name" class="form-control">
			</label>
		</div>
		<div class="form-group">
			<label>Email: 
				<input type="email" name="upemail" id="up_email" placeholder="Email" class="form-control">
			</label>
		</div>
		<div class="form-group">
			<label>Phone: 
				<input type="text" name="upphone" id="up_phone" placeholder="Phone" class="form-control">
			</label>
		</div>
		<div class="form-group">
			<label>Password: 
				<input type="text" name="uppassword" id="up_password" placeholder="Password" class="form-control">
			</label>
		</div>
		<div class="form-group">
			<label>Change Image:
				<input type="file" name="myfile" id="up_myfile" class="form-control">
				        <input type="hidden" name="hiddenID" id="hiddenID" value="">
			</label>
		</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateUser()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </form>
    </div>

  </div>
</div>

<script>
function updateUser(){
  var upformData = new FormData($("#updateDataForm")[0]);
for (var pair of upformData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
}
    $.ajax({
        url:'crud.php',
        dataType: 'text',
        data: upformData,
        processData:false,   
        contentType: false,                   
        type: 'post',
        success: function(response,status){
            allUsers();
            alert(response);
        }
     });
}
/*function updateUser(){
	var userName = $('#up_userName').val();
	var email = $('#up_email').val();
	var phone = $('#up_phone').val();
	var pass = $('#up_password').val();
	var hiddenID = $('#hiddenID').val();
	$.post('crud.php',{
		hiddenID:hiddenID,
		userName:userName,
		email:email,
		phone:phone,
		pass:pass
	}, function(response,status){
		$('#myModal').modal('hide');
		allUsers();
	});
}*/
function editUser(uid){
	 $('#hiddenID').attr('value',uid);
	$.post('crud.php',{ uid:uid }, function(response,status){
		var user = JSON.parse(response);
		$('#up_userName').val(user.userName);
		$('#up_email').val(user.email);
		$('#up_phone').val(user.phone);
		$('#up_password').val(user.pass);
		$("#pp").attr("src", user.imgpath);
	});
	$('#myModal').modal('show');	
}
function deleteUser(deleteid){
	var confrm = confirm("Are you sure?");
	var userID = deleteid;
	if(confrm == true){
		$.ajax({
			url:'crud.php',
			type:'POST',
			data:{userID:userID},
		success:function(response,status){
			allUsers();
		}
		});
	}
}
allUsers();
function allUsers(){
	var allUsers="allUsers";
	$.ajax({
		url:'crud.php',
		type:'POST',
		data:{allUsers:allUsers},
		success:function(response,status){
			$('#allUsers').html(response);
		}
	});
}
function insertData(){
	var userName = $('#userName').val();
	var email = $('#email').val();
	var phone = $('#phone').val();
	var pass = $('#pass').val();
var file = document.getElementById('myfile').files[0];
 if(file){
 	if(file.size < 2097152) {
   } else {
     alert("File is  over 2Mb in size!");
     evt.preventDefault();
   }
 }    
	if(![userName,email,phone,pass].every(Boolean)){
		alert('All fields are required to submit.')
	}else{
  var formData = new FormData($("#insertDataForm")[0]);
    $.ajax({
        url:'crud.php',
        dataType: 'text',
        data: formData,
        processData:false,   
        contentType: false,                   
        type: 'post',
        success: function(response,status){
            alert(response);
            allUsers();
        }
     });
	}
}
/*function insertData(){
	//var myfile = $("#myfile").prop("files")[0];
	var userName = $('#userName').val();
	var email = $('#email').val();
	var phone = $('#phone').val();
	var password = $('#password').val();
	var addUser = "addUser";
	if(![userName,email,phone,password].every(Boolean)){
		alert('All fields are required to submit.')
	}else{
	$.ajax({
		url:'crud.php',
		type:'POST',
		data:{
			//myfile:myfile,
			userName:userName,
			email:email,
			phone:phone,
			pass:password,
			addUser:addUser
		},
		success:function(response,status){
			alert(response);
			allUsers();
		}
	});
}
}*/
</script>
</body>
</html>