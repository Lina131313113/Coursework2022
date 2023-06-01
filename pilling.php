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
   <title>Пилинги</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>Пилинги</h3>
   <p> <a href="home.php">Главная</a> / Пилинги </p>
</div>

<section class="massages">
    <img src="images/pilling-na-vibor.jpg" alt="massages" class="massage-img-2">
    <h2 class="massage-h2-2">Пилинги</h2>
    <p class="massage">Пилинг (от англ. to peel – очищать, отшелушить) - процедура, выполняемая с целью ухода и/или<br/>
    лечения кожи, заключающаяся в удалении различных слоев кожи.<br/>
    <br/>
    Наиболее популярными являются механический и химический пилинги. Механический пилинг<br>
    проводится с помощью абразивных материалов, которые при трении удаляют с поверхности кожи<br/>
    отмершие клетки. При химическом пилинге используются химические составы, действующие на<br/>
    различные молекулы клеток кожи и межклеточного вещества. Состав химического пилинга,<br/>
    концентрация кислот, длительность и регулярность воздействия, физико-химические свойства<br/>
    определяют эффект, оказываемый на кожу.</p>
    <a href="shop.php" class="massage-btn">Подробнее в Меню</a>
</section>

<?php include 'layouts/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>