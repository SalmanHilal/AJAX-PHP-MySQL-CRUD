<!DOCTYPE html><html><head><title>AJAX CRUD Operations</title><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="assets/bootstrap.min.css"><script src="assets/jquery.min.js"></script><script src="assets/bootstrap.min.js"></script><style>label{width:95%}#insertDataForm .form-control{display:inline-block;width:85%}#insertDataForm label span{width:14%;display:inline-block}.btnc{margin-left:13.5%}input[type=file]{display:inline-block}#myfile{
    margin-left:7%}.img{text-align:center;max-width:70px}.img img{height:max-content;max-height:70px}</style></head><body>
<div class="container"><div class="container-fluid">
	<h2 class="text-center text-primary">AJAX CRUD Operations</h2>
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
<div class="container">
<h3>All Users</h3>
	<div id="allUsers">
	</div>	
</div>
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