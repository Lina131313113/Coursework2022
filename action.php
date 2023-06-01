<?php
include 'config.php';
session_start();

$page_title = 'Массажный салон Asia Beauty';
$page_style = 'user';
$user_id = $_SESSION['user_id'];

?>

<?php include 'layouts/head.php'; ?>
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>корзина покупок</h3>
   <p> <a href="index.php">Главная</a> / Корзина </p>
</div>

<section class="action-title">
    <div class="section-title">
        <h2>Акции</h2>
        <p>Asia Beauty</p>
        <hr class="hr3">
    </div>
</section>

<section class="action">
    <div class="action-images">
        <a href="#">
            <img src="images/12.png" class="action" class="action-img">
        </a>
    </div>
    <div class="action-content">
        <h4>Ресторан в апартаментах после 23:00</h4>
        <p>Заказывайте еду в VIP-апартаменты с 
        <br/>
        культового ресторана Сан</p>
    </div>
</section>

<?php include 'layouts/footer.php'; ?>