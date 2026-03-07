<?php
include "config.php";

if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $query="SELECT * FROM admin WHERE username='$username' AND password='$password' ";
    $result=mysqli_query($conn,$query);

    if(mysqli_num_rows($result)==1){
        header("Location:dashboard.php");
    }
    else{
        echo "Invalid Login";
    }
}
?>

<h2>Admin Login</h2>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<br><br>

<input type="password" name="password" placeholder="Password" required>
<br><br>

<button name="login">Login</button>
</form>