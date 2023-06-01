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
   <title>Балийские Массажи</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>Балийские Массажи</h3>
   <p> <a href="home.php">Главная</a> / Балийские Массажи </p>
</div>

<section class="massages">
    <img src="images/massages.jpg" alt="massages" class="massage-img">
    <h2 class="massage-h2">Балийские Массажи</h2>
    <p class="massage">В эпоху колонизации культура острова Бали оказалась под влиянием европейский и азитаских<br/>
    стран. Тогда и родилась уникальная техника балийского массажа, которая стала симбиозом<br/>
    различных восточных методик, направленных на восстановление духовных и физических сил.<br/>
    <br/>
    Расслабляющие поглаживания гармонично сочетаются с интенсивной точечной стимуляцией и<br/>
    ароматерапией. Отдельное внимание уделяется ступням и ушам, так как считается, что эти<br/>
    части тела имеют точки, перекликающиеся с органами и нервной системой. Акупрессура<br/>
    (техника надавливания) позволяет не только безболезненно и эффективно снять мышечное<br/>
    напряжение, ускорить кровоток, вывести из организма токсины и лишнюю воду, но и оказать<br/>
    положительное влияние на эмоциональный фон.<br/>
    <br/>
    Эфирные масла подбираются индивидуально в зависимости от особенностей кожи, чтобы во время<br/>
    растирания они не вызвали аллергическую реакцию. Чаще всего используют жасмин, розу и<br/>
    сандал, которые успокаивают сознание, снимают стресс и повышают выработку гормонов счастья.<br/>
    <br/>
    В начале мастер прорабатывает ноги, торс и руки, задействуя свои локти и внутренние<br/>
    поверхности ладоней, чтобы растянуть мышцы, облегчить боль в суставах и других очагах.<br/>
    Далее следует глубокая рефлексотерапия лица и головы, которая нацелена на лечения головных<br/>
    болей, стабилизацию сна и повышению общего тонуса.<br/>
    <br/>
    Благодаря сочетанию нескольких техник балийский массаж является универсальной лечебной<br/>
    процедурой. Терапевты рекомендует его после спортивных травм, для повышения тонуса при<br/>
    малоподвижном образе жизни и борьбе с хроническими нервными заболеваниями.</p>
    <a href="shop.php" class="massage-btn">Подробнее в Меню</a>
</section>

<?php include 'layouts/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>