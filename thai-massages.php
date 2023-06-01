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
   <title>Тайские Массажи</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>Тайские Массажии</h3>
   <p> <a href="home.php">Главная</a> / Тайские Массажи </p>
</div>

<section class="massages">
    <img src="images/massages.jpg" alt="massages" class="massage-img">
    <h2 class="massage-h2">Тайские Массажи</h2>
    <p class="massage">Техника тайского массажа формировалась столетиями на основе филосифии и практик Индии,<br/>
    Китая и Бирмы. Авторство каноничной методики приписывается целителю Кумару Бхаши, который<br/>
    служил при дворе индийских монархов. К сожалению, все письменные свидетельства о методах<br/>
    его лечения, сделанные после XIII века, были уничтожены германскими войсками и сгорели<br/>
    вместе с Королевской библиотекой.<br/>
    Благо, ученики Кумара передавали знания из уст в уста и спустя столетия поделились знаниями,<br/>
    которые определили два основных вида тайского массажа.<br/>
    <b>Королевский массаж</b><br/>
    Исключает прямой контакт и выполняется на расстоянии вытянутых рук от массируемого.<br/>
    Методика напрямую связана с народными традициями, где было непозволительно вплотную<br/>
    приближаться к Королю. Мастер передвигается вокруг гостя на коленях и задействует в работе<br/>
    только ладони, чтобы выразить почтение к знати и своему пациенту.<br/>
    <b>Сегодня процедура проводится в кимоно на матах и включает следующие манипуляции:</b><br/>
    - растягивание мышц и сухожилий<br/>
    - поднимание разных частей тела</br/>
    - волнообразное встряхивание конечностей<br/>
    - вращение суставов<br/>
    Несмотря на интенсивную мануальную технику, королевский массаж потрясающе расслабляет.<br/>
    Во многом благодаря созданной атмосфере с приглушенным светом, медитативной музыкой и<br/>
    ароматными благовониями.</p>
    <a href="shop.php" class="massage-btn">Подробнее в Меню</a>
</section>

<?php include 'layouts/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>