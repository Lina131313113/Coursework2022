<?php

include 'config.php';
session_start();

$page_title = 'Поиск';
$page_style = 'user';
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'уже добавлены в корзину!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_inf', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'товар добавлен в корзину!';
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Страница Поиска</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'layouts/head.php'; ?>
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>страница поиска</h3>
   <p> <a href="home.php">Главная</a> / Поиск </p>
</div>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="поиск продуктов..." class="box">
      <input type="submit" name="submit" value="поиск" class="btn">
   </form>
</section>

<section class="products-2" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
   ?>
   <form action="" method="post" class="box">
      <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
      <div class="name"><?php echo $fetch_product['name']; ?></div>
      <div class="price">₽<?php echo $fetch_product['price']; ?>/-</div>
      <input type="number"  class="qty" name="product_quantity" min="1" value="1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
      <input type="submit" class="btn" value="добавить в корзину" name="add_to_cart">
   </form>
   <?php
            }
         }else{
            echo '<p class="empty-2">результат не найден!</p>';
         }
      }else{
         echo '<p class="empty-2">поищите что-нибудь!</p>';
      }
   ?>
   </div>
  

</section>









<?php include '<layouts>footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>