<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php $_SESSION['username']?></title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            overflow-x:hidden;
        }
        .profile_img{
            width:90%;
            margin:auto;
            display: block;
            object-fit:contain;
        }
        .edit_image{
            width:100px;
            height:100px;
            object-fit:contain;
        }
    </style>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="../images/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">My account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-solid 
          fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php total_cart_price();?>$</a>
        </li>
        
      </ul>
      <form class="d-flex" action="../search_product.php" method="get">
        <input class="form-control me-2" type="search" 
        placeholder="Search" aria-label="Search" name="search_data">
        <input type="submit" value="Search" class="btn 
        btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<!--calling cart function -->
<?php cart(); ?>

<!--second child-->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <ul class="navbar-nav me-auto">
    <li class="nav-item">
          <a class="nav-link" href="#">Welcome Guest</a>
    </li>
    <li class="nav-item">
          <a class="nav-link" href="#">Login</a>
    </li>
  </ul>
</nav>
<!--third child-->
<div class="bg-light">
  <!--name of the store-->
  <h3 class="text-center">Ara Store</h3>
  <!--captio-->
  <p class="text-center">What matter to us is your satisfaction</p>
</div>

<!--fourth child-->
<div class="row">
    <div class="col-md-2">
        <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
        <li class="nav-item bg-info">
          <a class="nav-link" aria-current="page" href="#"><h4>Profile</h4></a>
        </li>
        <?php
        $username=$_SESSION['username'];
        $user_image="Select * from 'user_table' where username='$username'";
        //$result_image=mysqli_query($con, "Select * from 'user_table' where username='$username'");
        $result_image=mysqli_query($con, $user_image);
        $row_image=mysqli_fetch_array($result_image);
        $user_image=$row_image['user_image'];
        echo "<li class='nav-item'>
        <img src='./user_images/$user_image' class='profile_img my-4' alt=''>
        </li>";
        ?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="profile.php">Pending Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="profile.php?edit_account">Edit Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="profile.php?my_orders">My Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="profile.php?delete_account">Delete Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
        </li>
        </ul>
    </div>
    <div class="col-md-10">
        <?php get_user_order_details();
        if(isset($_GET['edit_account'])){
            include('edit_account.php'); 
        }
        ?>
    </div>
</div>
<!-- last child -->
<!-- include footer -->
<?php  include("../includes/footer.php") ?> 
    </div>
<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>