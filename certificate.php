<?php

include 'config.php';
session_start();

$page_title = 'Сертификаты';
$page_style = 'user';
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $certificate_name = $_POST['certificate_name'];
   $certificate_price = $_POST['certificate_price'];
   $certificate_image = $_POST['certificate_image'];
   $certificate_quantity = $_POST['certificate_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$certificate_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'уже добавлены в корзину!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$certificate_name', '$certificate_price', '$certificate_quantity', '$certificate_image')") or die('query failed');
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
   <title>Сертификаты</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'layouts/head.php'; ?>
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>Сертификаты</h3>
   <p> <a href="home.php">Главная</a> / Сертификаты </p>
</div>


<section class="products-2">
   
<h1 class="title">сертификаты</h1>

<div class="certificate-title">
      <h2>Подарочный сертификат в массажный салон</h2>
      <hr size="2">
      <p>В стильном конверте будет спрятана целая гамма незабываемых ощущений и возможность погрузиться в мир роскошных 
      <br/>   
      церемоний и spa-программ от лучших мастеров</p>
   </div>

   <div class="box-container">

      <?php  
         $select_certificates = mysqli_query($conn, "SELECT * FROM `certificates`") or die('query failed');
         if(mysqli_num_rows($select_certificates) > 0){
            while($fetch_certificates = mysqli_fetch_assoc($select_certificates)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_certificates['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_certificates['name']; ?></div>
      <div class="price">₽<?php echo $fetch_certificates['price']; ?>/-</div>
      <input type="number"  class="qty" name="certificate_quantity" min="1" value="1">
      <input type="hidden" name="certificate_name" value="<?php echo $fetch_certificates['name']; ?>">
      <input type="hidden" name="certificate_price" value="<?php echo $fetch_certificates['price']; ?>">
      <input type="hidden" name="certificate_image" value="<?php echo $fetch_certificates['image']; ?>">
      <input type="submit" value="добавить в корзину" name="add_to_cart" class="btn-2">
     </form>
     <?php
         }
      }else{
         echo '<p class="empty">еще не добавлено услуг!</p>';
      }
      ?>
   </div>

</section>

<?php include 'layouts/footer.php'; ?>>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>