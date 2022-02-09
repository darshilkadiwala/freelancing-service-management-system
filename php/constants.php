<?php 
define("MATCHPASSWORD", "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[ !\"#$%&\'()*+,.\/:;<=>?@\[\]^_\`{|}~-])[A-Za-z\d !\"#$%&\'()*+,.\/:;<=>?@\[\]\^_\`{|}~-]{8,16}$/");
define("MATCHUSERNAME", "/^[a-zA-Z0-9]{6,16}$/");
define("MATCHFLNAME","/^[a-zA-Z ]*$/");
define("MATCHEMAIL","/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/");
define("MATCHDOB","/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/");
define("MATCHCONTACTNO","/^[6-9]{1}[0-9]{9}$/");
define("MATCHADDRESS","/^[a-zA-Z0-9 \.,\/-]*$/");
define("MATCHPINCODE","/^\d{6}$/");

define("ERRORPASSWORD","Only Alphanumeric value allowed in Password,\nPassword must be minimum 8 and maximum 16 character");
define("ERRORUSERNAME","Only Alphanumeric value allowed in Username,<br/>Username must be maximum 16 character");
define("ERRORUSERNAMEPASSWORD","Invalid Username or password<br/>");
define("ERRORLETTERALLOWED","Only letters are allowed!!!");
define("ERRORDATE","Invalid date!!!");
define("ERRORGENDER","Invalid Gender selected!!!");
define("ERROREMAIL","Invalid Email format!!!");
define("ERRORCONTACTNO","Invalid Contact Number format!!!");
define("ERRORADDRESS","Only letters, number, space ,\'-\' ,\'/\' \',\' and \'.\' are allowed");
define("ERRORPINCODE","Invalid Pincode format!!!");

define("REQALL","All fields are required!!!");
define("REQFNAME","First Name is Required!!!");
define("REQLNAME","Last Name is Required!!!");
define("REQDOB","Birth Date is Required!!!");
define("REQPROFILE","Profile Picture is required!!!");
define("REQGENDER","Gender is Required!!!");
define("REQEMAIL","Email id is Required!!!");
define("REQCONTACTNO","Contact Number is Required!!!");
define("REQADDRESS","Address is Required!!!");
define("REQPINCODE","Pincode is Required!!!");
define("REQUSERNAME","Username is Required!!!");
define("REQPASSWORD","Password is Required!!!");

define("PASSCHANGE","Your Password changed Successfully!!!");
define("MATCHBOTHPASSWORD","Password are no matching. Both password must be same!!!");
define("INVALIDEMAIL","Invalid Email id!!!");
define("INVALIDUSERNAME","Invalid Username !!!");