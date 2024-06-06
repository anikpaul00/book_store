-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jun 06, 2024 at 06:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(58, 3, 'অসমাপ্ত আত্মজীবনী', 600, 1, 'Osmapto Attojiboni.jpg'),
(59, 3, 'নিতুর ডায়েরি ১৯৭১ ', 400, 2, 'নিতুর ডায়েরি ১৯৭১ _ দীপু মাহমুদ .jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(10, 3, 'ANIK', '01758404115', 'paulanik0099@gmail.com', 'ক্যাশ অন ডেলিভারি', 'flat no. 32, 21, Bagerhat - 1234', 'অসমাপ্ত আত্মজীবনী (1) ', 600, '05-Jun-2024', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `published_date` date NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `author`, `description`, `published_date`, `price`, `image`) VALUES
(1, 'অসমাপ্ত আত্মজীবনী', 'শেখ মুজিবুর রহমান', '\'অসমাপ্ত আত্মজীবনী  ২০০৪ সালে শেখ মুজিবুর রহমানের লেখা চারটি খাতা আকস্মিকভাবে তাঁর কন্যা শেখ হাসিনার হস্তগত হয়। খাতাগুলি অতি পুরানো, পাতাগুলি জীর্ণপ্রায় এবং লেখা প্রায়শ অস্পষ্ট। মূল্যবান সেই খাতাগুলি পাঠ করে জানা গেল এটি বঙ্গবন্ধুর অসমাপ্ত আত্মজীবনী, যা তিনি ১৯৬৭ সালের মাঝামাঝি সময়ে ঢাকা সেন্ট্রাল জেলে অন্তরীণ অবস্থায় লৈখা শুরু করেছিলেন, কিন্তু শেষ করতে পারেননি। জেল-জুলুম, নিগ্রহ-নিপীড়ন যাঁকে সদা তাড়া করে ফিরেছে, রাজনৈতিক কর্মকাণ্ডে উৎসর্গীকৃত-প্রাণ, সদাব্যস্ত বঙ্গবন্ধু যে আত্মজীবনী লেখায় হাত দিয়েছিলেন এবং কিছুটা লিখেছেনও, এই বইটি তার সাক্ষর বহন করছে। বইটিতে আত্মজীবনী লেখার প্রেক্ষাপট, লেখকের বংশ পরিচয়, জন্ম, শৈশব, স্কুল ও কলেজের শিক্ষাজীবনের পাশাপাশি সামাজিক ও রাজনৈতিক কর্মকাণ্ড, দুর্ভিক্ষ, বিহার ও কলকাতার দাঙ্গা, দেশভাগ, কলকাতাকেন্দ্রিক প্রাদেশিক মুসলিম ছাত্রলীগ ও মুসলিম লীগের রাজনীতি, দেশ বিভাগের পরবর্তী সময় থেকে ১৯৫৪ সাল অবধি পূর্ব বাংলার রাজনীতি, কেন্দ্রীয় ও প্রাদেশিক মুসলিম লীগ সরকারের অপশাসন, ভাষা আন্দোলন, ছাত্রলীগ ও আওয়ামী লীগ প্রতিষ্ঠা, যুক্তফ্রন্ট গঠন ও নির্বাচনে বিজয়ী হয়ে সরকার গঠন, আদমজীর দাঙ্গা, পাকিস্তান কেন্দ্রীয় সরকারের বৈষম্যমূলক শাসন ও প্রাসাদ ষড়যন্ত্রের বিস্তৃত বিবরণ এবং এসব বিষয়ে লেখকের প্রত্যক্ষ অভিজ্ঞতার বর্ণনা রয়েছে। আছে লেখকের কারাজীবন, পিতা-মাতা, সন্তান-সন্ততি ও সর্বোপরি সর্বংসহা সহধর্মিণীর কথা, যিনি তাঁর রাজনৈতিক জীবনে সহায়ক শক্তি হিসেবে সকল দুঃসময়ে অবিচল পাশে ছিলেন। একইসঙ্গে লেখকের চীন, ভারত ও পশ্চিম পাকিস্তান ভ্রমণের বর্ণনাও বইটিকে বিশেষ মাত্রা দিয়েছে। শেখ মুজিবুর রহমান ১৯২০ সালে জন্মগ্রহণ করেন। কলকাতা বিশ্ববিদ্যালয় থেকে বি.এ. ডিগ্রি লাভ করেন ও ঢাকা বিশ্ববিদ্যালয়ে আইন বিভাগে অধ্যয়ন করেন। ১৯৪৯ সালে প্রতিষ্ঠিত রাজনৈতিক দল আওয়ামী মুসলিম লীগের প্রতিষ্ঠাতাদের অন্যতম। তিনি তাঁর দল আওয়ামী লীগকে ১৯৭০ সালের জাতীয় ও প্রাদেশিক নির্বাচনে নিরঙ্কুশ সংখ্যাগরিষ্ঠ আসনে বিজয়ী করেন। তাঁর এই অর্জন স্বাধীন ও সার্বভৌম বাংলাদেশের অভ্যুদয়ের অন্যতম প্রেক্ষাপট রচনা করে। ১৯৭১ সালের ৭ মার্চ তিনি এক ঐতিহাসিক ভাষণে অসহযোগ আন্দোলনের ডাক দিয়ে ঘোষণা করেন, “এবারের সংগ্রাম আমাদের মুক্তির সংগ্রাম, এবারের সংগ্রাম স্বাধীনতার সংগ্রাম।” ঐ সংগ্রামের জন্য তিনি জনগণকে “যা কিছু আছে তাই নিয়ে” প্রস্তুত থাকতে বলেন। তিনি ২৬ মার্চ স্বাধীনতার ঘোষণা দেন ও পাকিস্তানী সেনাবাহিনীর হাতে গ্রেফতার হন। নির্বাচিত গণপ্রতিনিধিরা ১০ এপ্রিল বঙ্গবন্ধু শেখ মুজিবুর রহমানকে রাষ্ট্রপতি নির্বাচিত করে গণপ্রজাতন্ত্রী বাংলাদেশ সরকার গঠন করেন। তাঁরা স্বাধীনতার ঘোষণাপত্র জারি করেন এবং বঙ্গবন্ধুর নেতৃত্বে মুক্তিযুদ্ধ পরিচালনা করেন। ১৬ ডিসেম্বর বিজয় অর্জন হলে শেখ মুজিব পাকিস্তানের কারাগার থেকে মুক্ত হয়ে ১০ জানুয়ারি বীরের বেশে স্বদেশ প্রত্যাবর্তন করেন। বাঙালির অবিসম্বাদিত নেতা হিসেবে শেখ মুজিবুর রহমান জীবদ্দশায় কিংবদন্তী হয়ে ওঠেন।', '2004-01-01', 600, 'Osmapto Attojiboni.jpg'),
(2, 'আলবদর ১৯৭১ ', 'মুনতাসীর মামুন', '\"আলবদর এক বিস্ময়!\" বইটি ১৯৭১ সালে মানবতাবিরোধী অপরাধে দায়ী জামায়াতে ইসলামীর নেতাদের নিয়ে লেখা হয়েছে। আলবদররা মুক্তিযোদ্ধাদের বিরুদ্ধে পাকিস্তানি গণহত্যা ও ধর্ষণে অংশ নিয়েছিল এবং নির্দিষ্টভাবে বুদ্ধিজীবীদের হত্যা করেছিল। এ বাহিনীর প্রধান ছিলেন আলী আহসান মুজাহিদ এবং অন্য নেতারা ছিলেন কাদের মোল্লা ও কামরুজ্জামান। আলবদরের সদস্য সংখ্যা ছিল প্রায় ৭৩ হাজার। ড. মুনতাসীর মামুন এই গ্রন্থে তাদের কীর্তিকাহিনী তুলে ধরেছেন, যা বাংলা ভাষায় আলবদরদের সম্পর্কে প্রথম বই।', '2018-01-01', 450, 'আলবদর ১৯৭১ (হার্ডকভার) .jpeg'),
(3, 'অগ্নিকিশোর ১৯৭১', 'রফিকুর রশীদ ', 'অগ্নিকিশোর ১৯৭১ বইটি রফিকুর রশীদ লিখিত একটি উল্লেখযোগ্য রচনা, যা ১৯৭১ সালের মুক্তিযুদ্ধের সময়কালের ঘটনাবলী এবং তৎকালীন কিশোরদের অবদানকে কেন্দ্র করে রচিত হয়েছে। বইটিতে মুক্তিযুদ্ধের নানান দিক তুলে ধরা হয়েছে, বিশেষ করে সেই সময়ে কিশোরদের সাহসী ভূমিকা। মুক্তিযুদ্ধে কিশোরদের অবদান, তাদের ত্যাগ, বীরত্ব এবং প্রতিকূল পরিস্থিতির মধ্যে তারা কিভাবে দেশের স্বাধীনতার জন্য সংগ্রাম করেছে তা অত্যন্ত সুন্দরভাবে বর্ণনা করা হয়েছে। লেখক রফিকুর রশীদ তাঁর লেখনীতে ইতিহাসের গুরুত্বপূর্ণ ঘটনাগুলোকে কিশোরদের দৃষ্টিকোণ থেকে উপস্থাপন করেছেন, যা পাঠকদের অনুপ্রাণিত করে। এছাড়াও, বইটিতে বিভিন্ন কিশোর মুক্তিযোদ্ধার ব্যক্তিগত অভিজ্ঞতা এবং স্মৃতিচারণ স্থান পেয়েছে।', '1989-01-01', 400, 'অগ্নিকিশোর ১৯৭১ _ রফিকুর রশীদ .jpg'),
(4, 'শান্তিবাহিনী: গেরিলা জীবন', 'গোলাম মর্তুজা', 'মুক্তিযুদ্ধের সময় শান্তিবাহিনীর গেরিলা যোদ্ধাদের জীবন ও তাদের দুঃসাহসিক অভিযানের বিবরণ। সংগ্রামের নানা দিক, সাহসিকতা এবং দেশের প্রতি তাদের অপরিসীম ত্যাগের কাহিনী তুলে ধরা হয়েছে।', '1988-04-05', 500, 'শান্তিবাহিনী _ গেরিলা জীবন.png'),
(5, 'শরণার্থীর জবানবন্দি ১৯৭১ ', 'পপি দেবী থাপা', 'মুক্তিযুদ্ধের সময় শরণার্থীদের জীবনের করুণ চিত্র তুলে ধরা হয়েছে। তাদের সংগ্রাম, বেদনা এবং বেঁচে থাকার লড়াইয়ের অভিজ্ঞতার বর্ণনা রয়েছে। বাস্তব অভিজ্ঞতাভিত্তিক একটি মর্মস্পর্শী রচনা।', '2023-02-02', 550, 'শরণার্থীর জবানবন্দি ১৯৭১ _ পপি দেবী থাপা .jpg'),
(6, 'বাঙালী জাতির ইতিহাস ', 'নাসির আলী', 'বাঙালী জাতির ঐতিহাসিক উত্থান, সাংস্কৃতিক বিকাশ, এবং সামাজিক পরিবর্তনের ধারাবাহিক বিবরণ। প্রাচীন থেকে আধুনিক যুগ পর্যন্ত বাঙালির সংগ্রাম, গৌরব, এবং ঐতিহ্যের চিত্র তুলে ধরেছে।', '1976-11-01', 350, 'বাঙালী জাতির ইতিহাস_.jpg'),
(7, 'আখ্যান ১৯৭১ ', 'সাঈদ হাসান দারা', '১৯৭১ সালের মুক্তিযুদ্ধের পটভূমিতে রচিত বিভিন্ন ঘটনার সংকলন। যুদ্ধের নানাদিক, সংগ্রাম, বীরত্ব এবং সাধারণ মানুষের অভিজ্ঞতার বর্ণনা রয়েছে। ইতিহাসের এক জীবন্ত চিত্র তুলে ধরেছে এই বইটি।', '1979-12-04', 450, 'আখ্যান ১৯৭১ (হার্ডকভার).jpeg'),
(8, 'যুগান্তর', 'মানিক বন্দ্যোপাধ্যায়', 'বাংলার গ্রামীণ সমাজের জীবনের বাস্তবতা ও সংগ্রামের চিত্র অঙ্কিত। মূলত কৃষক জীবনের সুখ-দুঃখ, আশা-নিরাশা, এবং সংগ্রামকে কেন্দ্র করে রচিত একটি কালজয়ী উপন্যাস।', '1953-11-11', 600, 'Jugantor.jpg'),
(9, 'নিতুর ডায়েরি ১৯৭১ ', 'দীপু মাহমুদ', '১৯৭১ সালের মুক্তিযুদ্ধের প্রেক্ষাপটে এক কিশোরীর ডায়েরির আদলে লেখা। নিতুর চোখে দেখা মুক্তিযুদ্ধের কষ্ট, সংগ্রাম ও সাহসিকতার কাহিনী ফুটে উঠেছে এই বইতে।', '2016-11-11', 400, 'নিতুর ডায়েরি ১৯৭১ _ দীপু মাহমুদ .jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'ANIK', 'paulanik2020@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(2, 'SWASTY DEY', 'swasty@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(3, 'ANIK', 'paulanik0099@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
