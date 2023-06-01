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
   <title>Китайские Массажи</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>Китайские Массажи</h3>
   <p> <a href="home.php">Главная</a> / Китайские Массажи </p>
</div>

<section class="massages">
    <img src="images/massages.jpg" alt="massages" class="massage-img">
    <h2 class="massage-h2">Китайские Массажи</h2>
    <p class="massage">Когда мучают болевые ощущения в спине, а сил нет уже к обеду, попробуйте китайский массаж.<br/>
    Мастер работает не только с телом, но и с энергией. Согласно, древнему учению, наше тело<br/> 
    пронизывает жизненная энергия Ци. И если её потоки заблокированы, появляется упадок сил,<br/> 
    сложно утром встать с постели, дела откладываются на потом, ничего не хочется...<br/>
    Китайский мастер же будто сканирует организм, находит блоки, снимает напряжение и<br/> 
    высвобождает энергию. Ритуал проходит без капли масла, через почти невесомую ткань.<br/>
    Так пальцы не скользят - и проще добраться до нужной точки.<br/>
    <b>После курса китайского массажа:</b><br/>
    Энергия станет бить фонтаном и даже после 5 часов сна будете чувствовать себя бодрым и<br/>
    отдохнувшим. Появится ощущение юношеской бодрости, захочется реализовать все задуманные<br/>
    планы, глаза будут гореть ярче, и сил будет больше. Болевые ощущения останутся в прошлом,<br/>
    станете ощущать себя лет на 5 моложе. На днях гость поделился с нами своим наблюдением:<br/>
    «До курса массажа мне было сложно пробежать и километр, а сейчас я готовлюсь к участию <br/>
    в марафоне». Китайский массаж в Asia Beauty Spa - уникальный способ оздоровления организма,<br/>
    снятия усталости и получения заряда энергии.Отыскать в столице действительно опытного<br/>
    китайского мастера очень сложно, такие специалисты сейчас на вес золота. Но с Asia Beauty<br/>
    всё возможно. Недаром, нас называют лучшим spa-салоном Москвы.</p>
    <a href="shop.php" class="massage-btn">Подробнее в Меню</a>
</section>

<?php include 'layouts/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>