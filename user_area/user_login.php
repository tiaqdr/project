<?php include('../includes/connect.php');
include('../functions/commonfunctions.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-eqiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial=scale=1.0">
    <title>User Login</title>
    <!-- bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- font awsome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            overflow-x:hidden;
        }
    </style>
</head>

<body> 
<!--margine-->
<div class="container fluid my-3">
    <h2 class="text-center">User Login</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
                                      <!--for storing images inside db-->
        <form action="" method="post">
            <!--username-->
            <div class="form-outline mb-4">
                <label for="user_username" class="form-label">Username</label>
                <input type="text" id="user_username" class="form-control"
                placeholder="Enter your username." autocomplete="off" required="requiered" name="user_username"/>
            </div>
            <!--password-->
            <div class="form-outline mb-4">
                <label for="user_password" class="form-label">Password</label>
                <input type="password" id="user_password" class="form-control"
                placeholder="Enter your password." autocomplete="off" required="requiered" name="user_password"/>
            </div>
            <!--button-->
            <div class="text-center">
                <input type="submit" value="Login" class="bg-info py-2 px-3 border-0 name=user_login">
                <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="user-registration.php" 
                 class="text-danger"> Register</a></p>
            </div>
            
        </form>
        </div>
    </div>
</div>
   
</body>
</html>

<?php
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];
    $select_query="Select * from 'user_table' where username='$user_username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();

    //cart item
    $select_query_cart="Select * from 'cart_details' where ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);
    if($row_count>0){
        $_SESSION['username']=$user_username;
        if(password_verify($user_password,$row_data['user_password'])){
            //if user has logged in and there are no items in cart->redirecting to profile page
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['username']=$user_username;
                echo "<script>alert('You have successfully logged in!')</script>";
                echo "<script>window.open('profile.php')</script>";
            }
            //redirecting to payment page
            else{
                $_SESSION['username']=$user_username;
                echo "<script>alert('You have successfully logged in!')</script>";
                echo "<script>window.open('payment.php')</script>";
            }
        }
        else{
            echo "<script>alert('Invalid Credentials!')</script>";
        }
    }
    else{
        echo "<script>alert('Invalid Credentials!')</script>";
    }
}