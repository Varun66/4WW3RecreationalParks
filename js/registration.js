/*This file contains javascript for the Registration page*/
/**/
/*This function validates the registration form for valid inputs*/
function validateForm() {
  /*Makes sure the name input is not empty*/
  var x = document.forms["registerForm"]["name"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }
  /*Makes sure the email input is not empty*/
  var x = document.forms["registerForm"]["email"].value;
  if (x == "") {
    alert("Email must be filled out");
    return false;
  }
  /*Makes sure the email input is in the right format*/
  if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('email').value))) {
    alert("Email is Invalid");
    return false;
  }
  /*Makes sure the password input is not empty*/
  var x = document.forms["registerForm"]["psw"].value;
  if (x == "") {
    alert("Password must be filled out");
    return false;
  }
  /*Makes sure the password must contain at least 1 number*/
  if (!(document.forms["registerForm"]["psw"].value.match(/[0-9]/g))){
    alert("The password must contain 1 number");
    return false;
  }
  /*Makes sure the password must contain at least 1 lowercase character*/
  if (!(document.forms["registerForm"]["psw"].value.match(/[a-z]/g))){
    alert("The password must contain 1 lower case letter");
    return false;
  }
  /*Makes sure the password must contain at least 1 uppercase character*/
  if (!(document.forms["registerForm"]["psw"].value.match(/[A-Z]/g))){
    alert("The password must contain 1 upper case letter");
    return false;
  }
  /*Makes sure the password must contain at least 8 character*/
  if (!(document.forms["registerForm"]["psw"].value.length >= 8)){
    alert("The password must have at least 8 characters");
    return false;
  }
  /*Makes sure the confirm password input is not empty*/
  var x = document.forms["registerForm"]["psw-confirm"].value;
  if (x == "") {
    alert("Confirm password must be filled out");
    return false;
  }
  /*Makes sure the password and confirm password match*/
  var x = document.forms["registerForm"]["psw"].value;
  var y = document.forms["registerForm"]["psw-confirm"].value;
  if (x != y) {
    alert("Password and confirm password must match");
    return false;
  }
}
