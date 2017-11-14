<?php
include 'header.php';
$errmsg_arr = array();
$errflag = false;
$username = "";
$password = "";
$error = "";
 
// database connection
$conn = new PDO("mysql:host=localhost:3306;dbname=cheapbooks","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


if(isset($_POST["username"]) && isset($_POST["password"]))
{
   $username = $_POST['username'];
   echo "Your Login Name or Password is invalid";
   $password = $_POST['password'];  
   
   if($username == '') {
   $errmsg_arr[] = 'You must enter your Username';
   $errflag = true;
}
if($password == '') {
   $errmsg_arr[] = 'You must enter your Password';
   $errflag = true;
}
}

$result = $conn->prepare("SELECT * FROM Customers WHERE username = '$username' and password = md5('$password')");
$result->execute();
$rows = $result->fetch(PDO::FETCH_NUM);
if($rows > 0) {
session_regenerate_id(true);
$_SESSION['cart']=[];
$_SESSION['counter']=0;
$_SESSION['login_user'] = $username;
         
header("location: search.php");
}
else{
   $errmsg_arr[] = 'Username and Password are not found';
   $errflag = true;
}
if($errflag) {
   $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
   session_write_close();
   //exit();
}
?>
<html>
   
   <head>
      <title>Login Page</title>
   </head>
   <body bgcolor = "#000000">
   
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  : </label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  : </label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" class = "box" value = " Login "/><br />
                  <br />
                  <input type="button" value="New users must register here" class = "box" onClick="document.location.href='register.php'" /><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
               
            </div>
            
         </div>
         
      </div>

   </body>
</html>