<?php include('../includes/connect.php');
include('../functions/commonfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-eqiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial=scale=1.0">
    <title>User Registration</title>
    <!-- bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- font awsome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body> 
<!--margine-->
<div class="container fluid my-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
                                      <!--for storing images inside db-->
        <form action="" method="post" enctype="multipart/form-data">
            <!--username-->
            <div class="form-outline mb-4">
                <label for="user_username" class="form-label">Username</label>
                <input type="text" id="user_username" class="form-control"
                placeholder="Enter your username." autocomplete="off" required="requiered" name="user_username"/>
            </div>
            <!--email-->
            <div class="form-outline mb-4">
                <label for="user_email" class="form-label">Email</label>
                <input type="email" id="user_email" class="form-control"
                placeholder="Enter your email." autocomplete="off" required="requiered" name="user_email"/>
            </div>
            <!--image-->
            <div class="form-outline mb-4">
                <label for="user_image" class="form-label">Image</label>
                <input type="file" id="user_image" class="form-control"
                required="requiered" nem="user_image"/>
            </div>
            <!--password-->
            <div class="form-outline mb-4">
                <label for="user_password" class="form-label">Password</label>
                <input type="password" id="user_password" class="form-control"
                placeholder="Enter your password." autocomplete="off" required="requiered" name="user_password"/>
            </div>
            <!--confirm password-->
            <div class="form-outline mb-4">
                <label for="conf_user_password" class="form-label">Confirm Password</label>
                <input type="password" id="conf_user_password" class="form-control"
                placeholder="Confirm your password." autocomplete="off" required="requiered" name="conf_user_password"/>
            </div>
            <!--Address-->
            <div class="form-outline mb-4">
                <label for="user_address" class="form-label">Address</label>
                <input type="text" id="user_address" class="form-control"
                placeholder="Enter your address." autocomplete="off" required="requiered" name="user_address"/>
            </div>
            <!--contact-->
            <div class="form-outline mb-4">
                <label for="user_contact" class="form-label">Contact</label>
                <input type="text" id="user_contact" class="form-control"
                placeholder="Enter your phone number." autocomplete="off" required="requiered" name="user_contact"/>
            </div>
            <div class="text-center">
                <input type="submit" value="Register" class="bg-info py-2 px-3 border-0 name=user_register">
                <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="user_login.php" 
                 class="text-danger"> Login</a></p>
            </div>
            
        </form>
        </div>
    </div>
</div>
   
</body>
</html>

<!-- if user_register is cliked, insert data into DB-->
<?php
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_temp=$_FILES['user_image']['temp_name'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_ip=getIPAddress();
}

//checking repeated username and emails & passwords are matched
$select_query="Select * from 'user_table' where username='$user_username' or user_email='$user_email'";
$result=mysqli_query($con,$select_query);
$rows_count=mysqli_num_rows($result);
if($rows_count>0){
    echo "<script>This username or email is already taken!('Data inserted successfully!')<\script>";
}
else if($user_password!=$conf_user_password){
    echo "<script>Passwords don't match!('Data inserted successfully!')<\script>";
}
else{
    //insert query
    move_uploaded_file($user_image_temp,"./user_images/$user_image");
    $insert_query="insert into'user_table' (username, user_email, user_password, user_image, user_ip, user_address, user_mobile)
    valuse ('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact'";
    $sql_execute=mysqli_query($con,$insert_query);
    if($sql_execute){
        echo "<script>alert('Data inserted successfully!')<\script>";
    }
    else{
        die(mysqli_error($con));
    }
}

//selecting cart items
$select_cart_items="Select * from 'cart_details' where ip_address='$user_ip'";
$result_cart=mysqli_query($con,$select_cart_items);
$rows_count=mysqli_num_rows($result_cart);
if($rows_count>0){
    $_SESSION['username']=$user_username;
    echo "<script>alert('You have some items in your cart.')<\script>";
    echo "<script>window.open('checkout.php', '_self')<\script>";
}
else{
    echo "<script>window.open('../index.php', '_self')<\script>";
}


?>