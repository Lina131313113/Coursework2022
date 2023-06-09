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
   $address = mysqli_real_escape_string($conn, ' '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('сбой запроса');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('сбой запроса');

   if($cart_total == 0){
      $message[] = 'ваша корзина пуста';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'заказ уже сделан!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('сбой запроса');
         $message[] = 'заказ размещен успешно!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('сбой запроса');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Проверка</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'layouts/head.php'; ?>
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>Проверка</h3>
   <p> <a href="home.php">Главная</a> / Проверка </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('сбой запроса');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '₽'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">ваша корзина пуста</p>';
   }
   ?>
   <div class="grand-total"> общая сумма: <span>₽<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>разместите свой заказ</h3>
      <div class="flex">
         <div class="inputBox">
            <span>ваше имя:</span>
            <input type="text" name="name" required placeholder="введите свое имя">
         </div>
         <div class="inputBox">
            <span>ваш номер:</span>
            <input type="number" name="number" required placeholder="введите свой номер">
         </div>
         <div class="inputBox">
            <span>ваш email:</span>
            <input type="email" name="email" required placeholder="введите свой email">
         </div>
         <div class="inputBox">
            <span>способ оплаты:</span>
            <select name="method">
               <option value="при получении">при получении</option>
               <option value="кредитная карта">кредитная карта</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>адрес строка:</span>
            <input type="number" min="0" name="flat" required placeholder="например, квартира №.">
         </div>
         <div class="inputBox">
            <span>адрес строка:</span>
            <input type="text" name="street" required placeholder="например, название улицы">
         </div>
         <div class="inputBox">
            <span>город:</span>
            <input type="text" name="city" required placeholder="например, казань">
         </div>
         <div class="inputBox">
            <span>область:</span>
            <input type="text" name="state" required placeholder="например, татарстан">
         </div>
         <div class="inputBox">
            <span>страна:</span>
            <input type="text" name="country" required placeholder="например, россия">
         </div>
         <div class="inputBox">
            <span>индекс:</span>
            <input type="number" min="0" name="pin_code" required placeholder="например, 123456">
         </div>
      </div>
      <input type="submit" value="заказать" class="btn" name="order_btn">
   </form>

</section>









<?php include 'layouts/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>