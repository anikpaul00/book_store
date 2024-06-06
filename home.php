<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'ইতিমধ্যে কার্টে যোগ করা হয়েছে!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'পণ্য কার্টে যোগ করা হয়েছে!';
   }

}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>মূল পৃষ্ঠা</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">
   <div class="content">
      <h3>হ্যান্ড পিকড বুক আপনার দরজায়।</h3>
      <p>আমাদের হাতে বাছাই করা বই সাবস্ক্রিপশন পরিষেবার সাথে পাঠের আনন্দ আবিষ্কার করুন। প্রতিটি মাসে, আপনার পছন্দ অনুসারে বিশেষভাবে উপযুক্ত উপন্যাসের একটি নির্বাচন গ্রহণ করুন, সরাসরি আপনার দরজায় পৌঁছে যাবে। আপনার বাড়ির আরাম ছেড়ে না গিয়ে নতুন গল্প এবং চিরন্তন গল্পের জাদু খুলুন।</p>
      <a href="about.php" class="white-btn">আরও আবিষ্কার করুন</a>
   </div>
</section>

<section class="products">
   <h1 class="title">সাম্প্রতিক পণ্য</h1>
   <div class="box-container">
      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">৳<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="কার্টে যোগ করুন" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">এখনও কোন পণ্য যোগ করা হয়নি!</p>';
      }
      ?>
   </div>
   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">আরও দেখুন</a>
   </div>
</section>

<section class="about">
   <div class="flex">
      <div class="image">
         <img src="images/cover_back.jpg" alt="">
      </div>
      <div class="content">
         <h3>আমাদের সম্পর্কে</h3>
         <p>বেঙ্গল বুকসে, আমরা বাংলা সাহিত্যকে উদযাপন করতে ভালোবাসি। আমাদের লক্ষ্য হল পাঠকদের সর্বোচ্চ মানের এবং সাংস্কৃতিকভাবে গুরুত্বপূর্ণ বাংলা সাহিত্য সরবরাহ করা। আমরা বিশ্বাস করি গল্পের শক্তিতে যা অনুপ্রাণিত করে, শিক্ষা দেয় এবং মানুষকে একত্রিত করে। আমাদের গল্পগুলি পাঠকদের হৃদয়ে জীবন্ত রাখতে আমরা সরাসরি আপনার দরজায় পৌঁছে দিই।</p>
         <a href="about.php" class="btn">আরও পড়ুন</a>
      </div>
   </div>
</section>

<section class="home-contact">
   <div class="content">
      <h3>কোন প্রশ্ন আছে?</h3>
      <p>আমরা সাহায্য করতে এখানে আছি! আমাদের সাথে যোগাযোগ করুন।</p>
      <a href="contact.php" class="white-btn">যোগাযোগ করুন</a>
   </div>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
