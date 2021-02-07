$(document).ready(function() {
  $("#register").click(function() {
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var phoneNum = $("phoneNum").val();
    var password = $("#password").val();
    var cpassword = $("#cpassword").val();
    if (fname == '' || lname == '' || email == '' || password == '' || cpassword == '') {
      alert("Please fill all fields...!!!!!!");
    } else if ((password.length) < 8) {
      alert("Password should atleast 8 character in length...!!!!!!");
    } else if (!(password).match(cpassword)) {
      alert("Your passwords don't match. Try again?");
    } else {
      $.post("register.php", {
        name1: fname,
        name2: lname,
        email1: email,
        password1: password
      }, function(data) {
        if (data == 'You have Successfully Registered.....') {
          $("form")[0].reset();
        }
        alert(data);
      });
    }
  });
});
