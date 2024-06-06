<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="bn">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>রেজিস্টার</title>

   <!-- ফন্ট অসামী সিডিএন লিংক -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- কাস্টম সিএসএস ফাইল লিংক -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

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

   <form action="" method="post">
      <h3>এখন নিবন্ধন করুন</h3>
      <input type="text" name="name" placeholder="আপনার নাম লিখুন" required class="box">
      <input type="email" name="email" placeholder="আপনার ইমেইল লিখুন" required class="box">
      <input type="password" name="password" placeholder="আপনার পাসওয়ার্ড লিখুন" required class="box">
      <input type="password" name="cpassword" placeholder="আপনার পাসওয়ার্ড নিশ্চিত করুন" required class="box">
      <select name="user_type" class="box">
         <option value="user">ব্যবহারকারী</option>
         <option value="admin">অ্যাডমিন</option>
      </select>
      <input type="submit" name="submit" value="এখন নিবন্ধন করুন" class="btn">
      <p>আগে থেকে একটি অ্যাকাউন্ট আছে? <a href="login.php">এখনি লগইন করুন</a></p>
   </form>

</div>

</body>
</html>
