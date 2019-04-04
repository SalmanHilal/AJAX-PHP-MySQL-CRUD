allUsers();
setInterval(function(){ 
    allUsers();
}, 3000);
function allUsers(){
	var allUsersphp="allUsers";
	$.ajax({
		url:'crud.php',
		type:'POST',
		data:{allUsersphp:allUsersphp},
		success:function(response,status){
			$('#allUsers').html(response);
		}
	});
}