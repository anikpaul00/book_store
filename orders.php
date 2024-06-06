<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="bn">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>অর্ডার</title>

   <!-- ফন্ট আওয়াসাম সিডিএন লিংক -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- কাস্টম সিএসএস ফাইল লিংক -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>আপনার অর্ডার</h3>
   <p> <a href="home.php">হোম</a> / অর্ডার </p>
</div>

<section class="placed-orders">

   <h1 class="title">অর্ডার দিয়েছেন</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> অর্ডার করা হয়েছে : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> নাম : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> নাম্বার : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> ইমেল : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> ঠিকানা : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> পেমেন্ট মেথড : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> আপনার অর্ডার : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> মোট মূল্য : <span>৳<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> পেমেন্টের অবস্থা : <span style="color:<?php echo $fetch_orders['payment_status'] == 'pending' ? 'red' : 'green'; ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         <?php if($fetch_orders['payment_status'] == 'completed') { ?>
            <p><a href="invoices/invoice_<?php echo $fetch_orders['id']; ?>.pdf" class="btn">ডাউনলোড ইনভয়েস</a></p>
         <?php } ?>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">এখনো কোনো অর্ডার প্লেস করা হয়নি!</p>';
         }
      ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
