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
   <title>Массажи</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Массажи</h3>
   <p> <a href="home.php">Главная</a> / Массажи </p>
</div>

<section class="massages">
    <img src="images/massages.jpg" alt="massages" class="massage-img">
    <h2 class="massage-h2">Массажи</h2>
    <p class="massage">Мы радуем своих клиентов высококлассным массажем уже больше 15 лет. За это время<br/> 
    легендарная сеть наших салонов увеличилась до 6, и это ещё не предел. Нам хочется, чтобы как<br/> 
    можно у большего количества желающих была возможность насладиться нашими услугами на<br/> 
    высшем уровне.<br/>
    У нас квалифицированные мастера из Тайланда, Индонезии и Китая с 10-летним опытом работы,<br/> 
    множеством сертификатов из лучших массажных школ мира и благодарностями от довольных<br/> 
    клиентов. К нам не попадают обычные мастера, у нас работают только лучшие.<br/>
    Наши массажисты владеют уникальными древними техниками массажа, которые передаются из<br/> 
    поколения в поколение.
    Массаж проходит на основе люксовых масел от премиальных брендов, на<br/> 
    которые не возникает аллергических реакций. Кожа после них становится напитанной и<br/>
    бархатистой. Ароматы масел подбираются с учётом индивидуальных предпочтений.<br/>
    У нас самый шикарный гидротермальный комплекс в столице. Хаммам, джакузи, русские бани,<br/>
    соляная комната, бассейны и мн.др. Оказавшись здесь, отключаешься от реальности и мысленно<br/> 
    переносишься в атмосферу средиземноморского курорта.<br/>
    Мы работаем для вас без выходных и праздников 24 часа в сутки.</br/>
    У нас самое богатое spa-меню, состоящее из традиционных массажей и массажей, объединяющих<br/> 
    классические и современные методики.<br/>
    Для нас ваше комфортное состояние и высокое качество указываемых услуг - самое главное!</p>
    <a href="shop.php" class="massage-btn">Подробнее в Меню</a>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>