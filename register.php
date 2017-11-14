<?php
include 'header.php';
$conn = new PDO("mysql:host=localhost:3306;dbname=cheapbooks","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if(isset($_POST['register'])){

    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];
    $mypassword = md5($mypassword);
    $myaddress = $_POST['address'];
    $myphone = $_POST['phone'];
    $myemail = $_POST['email'];
 
    $query = "SELECT COUNT(username) AS num FROM customers WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':username', $myusername);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if($row['num'] > 0){
        die('That username already exists!');
    }

    $query = "INSERT INTO customers (username, password, address, phone, email) VALUES (:username, :password, :address, :phone, :email)";
    $stmt = $conn->prepare($query);
 
    $stmt->bindValue(':username', $myusername);
    $stmt->bindValue(':address', $myaddress);
    $stmt->bindValue(':phone', $myphone);
    $stmt->bindValue(':email', $myemail);
    $stmt->bindValue(':password', $mypassword);
 
    $result = $stmt->execute();
 
    if($result){
        $_SESSION['login_user']=$myusername;
            header("location: search.php");
    } 
}
?>

<!DOCTYPE html>

<html>
<head>
<title>Register</title>
</head>
<body>
<div id="main" class="container-fluid">
<div class="row-fluid">
<div class="centering text-center">
<h2 class="margin-left-30">Register Here!!</h2>
<div id="login">
<hr/>
<form action="" method="post">

<div class="form-group row">
<label class="col-sm-2 col-form-label">Username : </label>
<div class="col-sm-10">
<input type="text" class="form-control" style="width: 30em;" name="username" id="name" required="required" placeholder="Please Enter Username"/><br /><br />
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Password :</label>
<div class="col-sm-10">
<input type="text" class="form-control" style="width: 30em;" name="password" id="name" required="required" placeholder="Please Enter Password"/><br /><br />
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Address :</label>
<div class="col-sm-10">
<input type="text" class="form-control" style="width: 30em;" name="address" id="name" required="required" placeholder="Please Enter Address"/><br /><br />
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Phone :</label>
<div class="col-sm-10">
<input type="text" type="text" class="form-control" style="width: 30em;" name="phone" id="name" required="required" placeholder="Please Enter Phone Number"/><br /><br />
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Email :</label>
<div class="col-sm-10">
<input type="email" type="text" class="form-control" style="width: 30em;" name="email" id="email" required="required" placeholder="john123@gmail.com"/><br/><br />
</div>
</div>

<div class="form-group row">
           <div class="offset-sm-2 col-sm-50">
             <button type="submit" name="register" class="btn btn-primary">Register</button>
           </div>
         </div>

</form>
</div>
</div>
</div>
</div>
</body>
</html>