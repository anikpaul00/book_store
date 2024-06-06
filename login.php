<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }

   }else{
      $message[] = 'Incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="bn">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  
   <link rel="stylesheet" href="css/style.css">
   
   <style>
    
      body.login-page {
         min-height: 100vh;
         background: url('images/login_pic.avif') no-repeat center center/cover;
         display: flex;
         align-items: center;
         justify-content: center;
         margin: 0;
         padding: 0;
         font-family: Arial, sans-serif; 
      }
      .login-page .form-container 
      {
      padding: 2rem;
      background-color: rgba(255, 255, 255, 0.5); 
      border-radius: .5rem;
      box-shadow: var(--box-shadow);
      border: var(--border);
      text-align: center;
      position: relative;
      z-index: 1; 
      width: 80%; 
      max-width: 400px;  
      } 
   


      .login-page .form-container form {
         padding: 2rem;
         border-radius: .5rem;
         box-shadow: var(--box-shadow);
         border: var(--border);
         background-color: rgba(255, 255, 255, 0.8); 
         text-align: center;
      }

      .login-page .form-container form h3 {
         margin-bottom: 1.5rem;
         color: #333;
      }

      .login-page .form-container form .box {
         width: 100%;
         padding: 1.2rem 1.4rem;
         border: var(--border);
         background-color: var(--light-bg);
         font-size: 1.8rem;
         color: #333; 
         border-radius: .5rem;
         margin: 1rem 0;
      }

      .login-page .form-container form .btn {
         display: inline-block;
         margin-top: 1rem;
         padding: 1rem 3rem;
         cursor: pointer;
         color: #fff; 
         font-size: 1.8rem;
         border-radius: .5rem;
         text-transform: capitalize;
         background-color: var(--purple);
         border: none;
      }

      .login-page .form-container form .btn:hover {
         background-color: var(--black);
      }
   </style>
</head>
<body class="login-page">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
   <div class="form-container">
<!-- <img src="images/বেঙ্গল বুকস.png" alt="Logo" class="form-logo" loading="lazy"> -->
<form action="" method="post">
   <h3>বেঙ্গল বুকস</h3>
   
   <input type="email" name="email" placeholder="আপনার ইমেইল লিখুন" required class="box">
   <input type="password" name="password" placeholder="আপনার পাসওয়ার্ড লিখুন" required class="box">
   <input type="submit" name="submit" value="এখন লগইন করুন" class="btn">
   <p>আপনার একাউন্ট নেই? <a href="register.php">এখনি নিবন্ধন করুন</a></p>
</form>

</div>

</body>
</html>

</body>
</html>
