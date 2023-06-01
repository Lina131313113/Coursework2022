<?php
include 'config.php';
session_start();

$page_title = 'Массажный салон Asia Beauty';
$page_style = 'user';

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
}

?>

<?php include 'layouts/head.php'; ?>
<?php include 'layouts/header.php'; ?>

<section class="home">
   <div class="content">
      <h3>Asia Beauty</h3>
      <p> - это прекрасные Тайские, Китайские и Балийские массажи</p>
      <a href="about.php" class="white-btn">Телефон: +7 (495) 666-23-13  </a>
   </div>
</section>

<section class="aboutSite container">
   <h1>Уникальные массажи Asia Beauty</h1>
         <hr size="2">
            <p class="tit">Окунитесь в путешествие в разные уголки мира с Asia Beauty</p>
            <div class="m-items">
               <div class="m-item">
                  <a href="#" class="items visible show">
                     <img src="images/bali-uzor.png" alt="Балийский массаж" class="items-uzor">
                     <img src="images/bali-build.png" alt="Балийский массаж" class="items-img">
                  </a>
                  <span class="items-title">
                     <a>Балийские массажи</a>
                  </span>
                  <div class="items-info">
                     Таинство спа-культуры главного острова Индонезии: медитации, индийская аюрведа и современные техники древних массажей.
                  </div>
               </div>

               <div class="m-item">
                  <a href="#" class="items visible show">
                     <img src="images/thai-uzor.png" alt="Тайский массаж" class="items-uzor">
                     <img src="images/thai-build.png" alt="Тайский массаж" class="items-img">
                  </a>
                  <span class="items-title">
                     <a>Тайские массажи</a>
                  </span>
                  <div class="items-info">
                     Секреты очищения души и тела мыслей, которые совместили с Буддийскими практиками и Йогой на матах.
                  </div>
               </div>
               
               <div class="m-item">
                  <a href="#" class="items visible show">
                     <img src="images/china-uzor.png" alt="Китайский массаж" class="items-uzor">
                     <img src="images/china-build.png" alt="Китайский массаж" class="items-img">
                  </a>
                  <span class="items-title">
                     <a>Китайские массажи</a>
                  </span>
                  <div class="items-info">
                     Древнейшие техники оздоровления родом из Поднебесной ритуалы красоты Императорской Династии.
                  </div>
               </div>
               
            </div>


</section>

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

<section class="certificate visible container">
   <div class="certificate-container">
      <img src="images/sert.png" class="certificate-img show">
         <div class="certificate-content">
            <span>
               Подарочные сертификаты
               <br/>
               Asia Beauty
            </span>
            <p>
               Лучший подарок на любой праздник
               <br/>
               для самых близких
            </p>
            <a href="#" class="cerf-btn">Подробнее </a>
         </div>
   </div>
</section>

<section class="home-contact">
   <div class="content">
      <h3>есть какие-нибудь вопросы?</h3>
      <p>Задайте все интересующие вас вопросы по специальной форме.</p>
      <a href="contact.php" class="white-btn">связаться с нами </a>
   </div>

</section>

<?php include 'layouts/footer.php'; ?>