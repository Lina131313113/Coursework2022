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
   <title>Специальные Предложения</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>Специальные Предложения</h3>
   <p> <a href="home.php">Главная</a> / Специальные Предложения </p>
</div>

<!--блок специальных предложений-->
<section class="offers px-0">
   <h1>Специальные предложения</h1>
      <hr size="2">
      <p class="tit-2">Попробуйте специальные SPA - Процедуры для ухода за кожей лица и тела</p>
      <div class="offers-items">
         <a href="#" class="offers-item visible full-visible show">
            <img src="images/face.jpg" alt="Массаж лица" class="offers-img">
            <span>Массаж лица</span>
         </a>
         <a href="#" class="offers-item visible full-visible show">
            <img src="images/SPA.jpg" alt="SPA-процедуры" class="offers-img">
            <span>SPA-процедуры</span>
         </a>
         <a href="#" class="offers-item visible full-visible show">
            <img src="images/ban.jpg" alt="Банное меню" class="offers-img">
            <span>Банное меню</span>
         </a>
         <a href="#" class="offers-item visible full-visible show">
            <img src="images/choko.jpg" alt="Обертывания" class="offers-img">
            <span>Обертывания</span>
         </a>
      </div>
</section>

<?php include 'layouts/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>