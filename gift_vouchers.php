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
      $message[] = 'уже добавлены в корзину!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'товар добавлен в корзину!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Подарочные Сертификаты</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'layouts/head.php'; ?>
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>Подарочные Сертификаты</h3>
   <p> <a href="home.php">Главная</a> / Подарочные Сертификаты </p>
</div>

<section class="massages">
    <img src="images/choko-obertivanie.jpg" alt="massages" class="massage-img-2">
    <h2 class="massage-h2-2">Подарочные Сертификаты</h2>
    <p class="massage">Подарочный сертификат – это документ, подтверждающий авансовый платеж и дающий право на получение<br/>
    товаров и/или услуг на сумму, эквивалентную номиналу сертификата.<br/>
    <br/>
    Приобретая подарочный сертификат, Вы заранее оплачиваете покупку и получаете возможность не <br/>
    ломать голову над тем, что подарить, не тратить драгоценное время на бесконечный выбор подарков.<br/>
    Вы потратите на подарок именно ту сумму, которую запланировали. Человек, которому вы дарите<br/>
    этот Сертификат, сможет прийти и самостоятельно выбрать любой понравившейся ему товар/услугу<br/>
    (любимый стиль, цвет, нужный размер и др.) на сумму, эквивалентную номиналу Сертификата.</p>
    <a href="about.php" class="massage-btn">Сертификаты</a>
</section>

<?php include 'layouts/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>