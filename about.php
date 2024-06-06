<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>আমাদের সম্পর্কে</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>আমাদের সম্পর্কে</h3>
   <p> <a href="home.php">হোম</a> / আমাদের সম্পর্কে </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/cover_back.jpg" alt="">
      </div>

      <div class="content">
         <h3>আমাদের কেন বেছে নিবেন?</h3>
         <p>বাংলা সাহিত্যের জীবন্ত প্রপাতে আপনারা সম্মর্থন করতে বেঙ্গল বইস চয়ন করুন। আমাদের দক্ষতাপূর্ণভাবে নির্বাচিত বই সমূহ স্থানীয় লেখকদের শ্রেষ্ঠ কাহিনী নিখুঁতভাবে প্রকাশ করে, ক্লাসিক মাস্টারপিস থেকে সমকালীন মুক্তকর্ম পর্যন্ত। প্রতিটি বই ডেলিভারি আমাদের ধনী সাহিত্যিক ঐতিহাসিক চিহ্নিত করে, যা সাবধানে প্যাকেজ করা হয় এবং আপনার দরজার সামনে পৌঁছানো হয়। বেঙ্গল বইস সঙ্গে, আপনি শুধুমাত্র একটি বই পড়ছেন না; প্রতি পৃষ্ঠা একটি নগরীর আত্মার অবহেলানুভূতি ধারণ করছেন।</p>
         <a href="contact.php" class="btn">যোগাযোগ করুন</a>
      </div>

   </div>

</section>


<section class="authors">

   <h1 class="title">উদ্যোক্তা ও প্রোগ্রামার</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/hamid.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>মামুনুর হামিদ</h3>
      </div>

      <div class="box">
         <img src="/images/anik.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>অনিক পাল</h3>
      </div>

      <div class="box">
         <img src="images/mridula.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>রুমাইয়া রহমান</h3>
      </div>


      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>