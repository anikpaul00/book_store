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

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="https://www.facebook.com/anikpaul.rocks.9" target="_blank" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter" target="_blank"></a>
            <a href="#" class="fab fa-instagram" target="_blank"></a>
            <a href="https://www.linkedin.com/in/anik-paul-b35170229/" target="_blank" class="fab fa-linkedin"></a>
         </div>
         <p> নতুন <a href="login.php">লগইন</a> | <a href="register.php">নিবন্ধন করুন</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         
         <a href="home.php" class="logo">বেঙ্গল বুকস</a>

         <nav class="navbar">
            <a href="home.php">প্রধান পৃষ্ঠা</a>
            <a href="about.php">আমাদের সম্পর্কে</a>
            <a href="shop.php">দোকান</a>
            <a href="contact.php">যোগাযোগ</a>
            <a href="orders.php">অর্ডারসমূহ</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>ব্যবহারকারীর নাম : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>ইমেইল : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">লগআউট</a>
         </div>
      </div>
   </div>

</header>
