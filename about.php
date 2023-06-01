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
   <title>О Нас</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>о нас</h3>
   <p> <a href="home.php">Главная</a> / О нас </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>почему выбрали нас?</h3>
         <p>ЭкспертПлюс - одна из ведущих консалтинговых
компаний в мире. Мы работаем с высшим руководством,
чтобы помочь им принимать более обоснованные решения,
преобразовывать эти решения в действия и обеспечивать
устойчивый успех, которого они желают.</p>
         <p>Мы работали с большинством компаний из списка
Global 500, тысячами крупных региональных и местных
организаций, сотнями некоммерческих организаций и
фондами прямых инвестиций.</p>
         <a href="contact.php" class="btn">связаться с нами</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">отзывы клиентов</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.jpg" alt="">
         <p>Спасибо компании ЭкспертПлюс, помогли мне с бухгалтерским учетом. Быстро и идеально. Буду чаще пользоваться Вашими услугами</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Екатерина Евдокимова</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.jpg" alt="">
         <p>Спасибо ЭкспертПлюс с помощью в расчете заработной платы для моих сотрудников. Обязательно еще обращюс в Вашу компанию.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Глеб Артемьев</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.jpg" alt="">
         <p>Спасибо ЭкспертПлюс с помощью в налоговом консалтинге, проконсультировали по уплате и исчислению налогов.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Диана Гайниева</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.jpg" alt="">
         <p>Спасибо Вам с помощью в юридическом впоросе, выполнили очень быстро и качественно.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Тимур Хохлов</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.jpg" alt="">
         <p>Спасибо с решением моего вопроса в теме налоговый консалтинг, качественная работа.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Даниил Егоров</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.jpg" alt="">
         <p>Спасибо ЭкспертПлюс в вопросе бухгалтерского учета. Обязательно обращусь к Вам еще.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Александра Котова</h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">сотрудники</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/author-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-vk"></a>
            <a href="#" class="fab fa-telegram"></a>
            <a href="#" class="fab fa-discord"></a>
            <a href="#" class="fab fa-youtube"></a>
         </div>
         <h3>Артем Рязанцев</h3>
      </div>

      <div class="box">
         <img src="images/author-2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-vk"></a>
            <a href="#" class="fab fa-telegram"></a>
            <a href="#" class="fab fa-discord"></a>
            <a href="#" class="fab fa-youtube"></a>
         </div>
         <h3>Дарья Мезенцева</h3>
      </div>

      <div class="box">
         <img src="images/author-3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-vk"></a>
            <a href="#" class="fab fa-telegram"></a>
            <a href="#" class="fab fa-discord"></a>
            <a href="#" class="fab fa-youtube"></a>
         </div>
         <h3>Алина Халиуллина</h3>
      </div>

      <div class="box">
         <img src="images/author-4.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-vk"></a>
            <a href="#" class="fab fa-telegram"></a>
            <a href="#" class="fab fa-discord"></a>
            <a href="#" class="fab fa-youtube"></a>
         </div>
         <h3>Артур Любимов</h3>
      </div>

      <div class="box">
         <img src="images/author-5.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-vk"></a>
            <a href="#" class="fab fa-telegram"></a>
            <a href="#" class="fab fa-discord"></a>
            <a href="#" class="fab fa-youtube"></a>
         </div>
         <h3>Ильдар Мухамадиев</h3>
      </div>

      <div class="box">
         <img src="images/author-6.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-vk"></a>
            <a href="#" class="fab fa-telegram"></a>
            <a href="#" class="fab fa-discord"></a>
            <a href="#" class="fab fa-youtube"></a>
         </div>
         <h3>Светлана Дмитрик</h3>
      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>