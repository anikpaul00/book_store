<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products = [];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
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
   <title>চেকআউট</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>চেকআউট</h3>
   <p> <a href="home.php">হোম</a> / চেকআউট </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '৳'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">আপনার কার্ট খালি</p>';
   }
   ?>
   <div class="grand-total"> সর্বমোট : <span>৳<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>আপনার অর্ডার দিন</h3>
      <div class="flex">
         <div class="inputBox">
            <span>আপনার নাম :</span>
            <input type="text" name="name" required placeholder="আপনার নাম লিখুন" pattern="[a-zA-Z\s]{1,40}">
         </div>
         <div class="inputBox">
            <span>মোবাইল নাম্বার :</span>
            <input type="text" name="number" required placeholder="আপনার মোবাইল নাম্বার লিখুন" pattern="^(\+88)?01[3-9]\d{8}$">
         </div>
         <div class="inputBox">
            <span>আপনার ইমেইল :</span>
            <input type="email" name="email" required placeholder="আপনার ইমেইল লিখুন" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
         </div>
         <div class="inputBox">
            <span>পেমেন্ট পদ্ধতি :</span>
            <select name="method">
               <option value="ক্যাশ অন ডেলিভারি">ক্যাশ অন ডেলিভারি</option>
               <option value="বিকাশ">বিকাশ (এই নম্বরে পাঠান 01303202332)</option>
               <option value="নগদ">নগদ (এই নম্বরে পাঠান 01303202332)</option>
            </select>
         </div>
         <div class="inputBox">
            <span>ঠিকানা লাইন ০১ :</span>
            <input type="text" name="flat" required placeholder="ফ্ল্যাট নম্বর লিখুন">
         </div>
         <div class="inputBox">
            <span>ঠিকানা লাইন ০২ :</span>
            <input type="text" name="street" required placeholder="স্ট্রিট নাম লিখুন">
         </div>
         <div class="inputBox">
            <span>শহর :</span>
            <input type="text" name="city" required placeholder="শহরের নাম লিখুন">
         </div>
         <div class="inputBox">
            <span>পিন কোড :</span>
            <input type="text" name="pin_code" required placeholder="পিন কোড লিখুন">
         </div>
      </div>
      <input type="submit" value="অর্ডার করুন" class="btn" name="order_btn">
   </form>

</section>

<?php include 'footer.php'; ?>


<script src="js/script.js"></script>

</body>
</html>
