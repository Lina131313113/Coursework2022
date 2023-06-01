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
   <title>Обертывания</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>Обертывания</h3>
   <p> <a href="home.php">Главная</a> / Обертывания </p>
</div>

<section class="massages">
    <img src="images/choko-obertivanie.jpg" alt="massages" class="massage-img-2">
    <h2 class="massage-h2-2">Обертывания</h2>
    <p class="massage">Обертывание – это косметическая процедура, которая проводится с целью ухода за кожей тела,<br/>
    коррекции фигуры и лечения целлюлита, подразумевающая нанесение на поверхность кожи<br/>
    специализированных составов, оказывающих влияние на микроциркуляцию, лимфоток и обмен веществ.<br/>
    При процедуре обертывания используются воздухопроницаемые пленки или термоодеяло, что<br/>
    необходимо для прогревания тканей.<br/>
    <br/>
    В основе специализированных смесей, наносящихся на проблемные участки кожи, могут быть морские<br/>
    и океанические водоросли, морская вода (содержит более 100 различных морских солей), лечебные<br/>
    грязи, глины (например, голубая или черная), морская соль, эфирные масла, травы.<br/>
    <br/>
    Океанические водоросли, например, активизируют метаболизм клеток, выводят токсины и застойную<br/>
    жидкость из организма, а морская вода нормализует водно-солевой обмен в организме и улучшает<br/>
    обмен веществ.</p>
    <a href="shop.php" class="massage-btn">Подробнее в Меню</a>
</section>

<?php include 'layouts/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>