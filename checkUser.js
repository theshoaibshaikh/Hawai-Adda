$(document).ready(function() {
var checking_html='Checking...';
$('#check_username_availability').click(function() {
	
$('#username_availability_result').html(checking_html);


check_availability();
});

});



function check_availability() {
var email=$('#email').val();
// use ajax to run the check
$.post("checkUser.php", { email : email },
function(result) {
if(result==1) {
$('#username_availability_result').html(email + ' already exists');
} else {
$('#username_availability_result').html(email + ' is Available');
}
});
}