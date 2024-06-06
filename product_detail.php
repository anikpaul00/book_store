<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_GET['id'])){
   $product_id = $_GET['id'];
   $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'") or die('query failed');

   if(mysqli_num_rows($select_product) > 0){
      $fetch_product = mysqli_fetch_assoc($select_product);
   } else {
      header('location:shop.php');
   }
} else {
   header('location:shop.php');
}

?>

<!DOCTYPE html>
<html lang="bn">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>পণ্য বিস্তারিত</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f2f2f2;
         margin: 0;
         padding: 0;
      }

      .product-detail {
         max-width: 1200px;
         margin: 20px auto;
         padding: 20px;
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0,0,0,0.1);
      }

      .box-container {
         display: flex;
         flex-wrap: wrap;
         gap: 20px;
         justify-content: center;
      }

      .box {
         background: #fff;
         border-radius: 10px;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
         overflow: hidden;
         max-width: 800px;
         display: flex;
         flex-direction: row;
         gap: 20px;
         padding: 20px;
         width: 100%;
      }

      .box img {
         max-width: 300px;
         max-height: 450px;
         object-fit: cover;
         border-radius: 10px;
      }

      .box .content {
         flex-grow: 1;
         display: flex;
         flex-direction: column;
         justify-content: space-between;
      }

      .box .content .name {
         font-size: 24px;
         font-weight: bold;
         color: #333;
         margin-bottom: 10px;
      }

      .box .content .author {
         font-size: 18px;
         color: #666;
         margin-bottom: 10px;
      }

      .box .content .description {
         font-size: 16px;
         color: #666;
         margin-bottom: 20px;
         text-align: justify;
      }

      .box .content .published_date {
         font-size: 16px;
         color: #999;
         margin-bottom: 20px;
      }

      .box .content .price {
         font-size: 20px;
         font-weight: bold;
         color: #E74C3C;
         margin-bottom: 20px;
      }

      .box .content form {
         display: flex;
         align-items: center;
         gap: 10px;
      }

      .box .content form .qty {
         width: 60px;
         padding: 5px;
         font-size: 16px;
         border: 1px solid #ddd;
         border-radius: 5px;
      }

      .box .content form .btn {
         padding: 10px 20px;
         font-size: 16px;
         background-color: #3498DB;
         color: #fff;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .box .content form .btn:hover {
         background-color: #2980B9;
      }
   </style>
</head>
<body>

<?php include 'header.php'; ?>

<section class="product-detail">

   <h1 class="title">পণ্য বিস্তারিত</h1>

   <div class="box-container">
      <div class="box">
         <img class="image" src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
         <div class="content">
            <div class="name"><?php echo $fetch_product['name']; ?></div>
            <div class="author">লেখক: <?php echo $fetch_product['author']; ?></div>
            <div class="description"><?php echo $fetch_product['description']; ?></div>
            <div class="published_date">প্রকাশিত: <?php echo $fetch_product['published_date']; ?></div>
            <div class="price">৳<?php echo $fetch_product['price']; ?>/-</div>
            <form action="shop.php" method="post">
               <input type="number" min="1" name="product_quantity" value="1" class="qty">
               <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
               <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
               <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
               <input type="submit" value="কার্টে যোগ করুন" name="add_to_cart" class="btn">
            </form>
         </div>
      </div>
   </div>

</section>


<script src="js/script.js"></script>

</body>
</html>
