<?php
  //$name = "Priyanka Cheema";
  $project = "CheapBooks";
  session_start();
  $defaultWarehouse = '789203';
  $secondaryWarehouse = '789204';
  $backupWarehouse = '789205';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Project4</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="/project4_Cheema_Priyanka/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script src="/project4_Cheema_Priyanka/bootstrap-3.3.7-dist/js/shopping.js"></script>

  <!-- Bootstrap -->
  <link href="/project4_Cheema_Priyanka/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/project4_Cheema_Priyanka/bootstrap-3.3.7-dist/css/style.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-light" style="background-color: #000000;">
<!-- <nav class="navbar navbar-default">-->
      <!-- <a href="search.php" class="navbar-brand"><?php echo $project?></a> -->
      <a class="navbar-brand"><?php echo $project?></a>
      <ul class="nav navbar-nav">
      </ul>
      <form class="form-inline float-xs-right">
       <!--  <span class="padding-right-20" style="color:whitesmoke"><?php echo $name?></span> -->
      </form>      
      <a href="logout.php" class="btn btn-primary float-xs-right">Logout</a>
      <a href="shoppingcart.php" class="btn btn-primary float-xs-right">Shopping Cart</a>
      <span id="cartCounter" class="text text-primary float-xs-right"><span class="glyphicon glyphicon-shopping-cart"></span><span class='counterval'><?php if(isset($_SESSION['counter'])) echo $_SESSION['counter'];?></span></span>

</nav>
