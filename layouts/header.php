<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!--Верхнее меню-->

<header class="header">
   <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="#" class="fab fa-vk"></a>
                <a href="#" class="fab fa-telegram"></a>
                <a href="#" class="fab fa-discord"></a>
                <a href="#" class="fab fa-youtube"></a>
            </div>
                <div class="flex1">
                    <a href="index.php" class="logo">Массажный салон Asia Beauty</a>
                </div>
                    <?php
                    if(isset($_SESSION['user_email']) && $_SESSION['user_email']){
                        echo "<p>Добро пожаловать, <b>$_SESSION[user_name]</b>";
                    }
                    else{
                    
                        echo "<p><a href='login.php'>Войти</a></p>";
                    }
                    ?>
        </div>
    </div>

    <!--Основное меню-->

   <div class="header-2">
        <div class="flex">
            <div class="menu-wrapper" role="navigation">
                <ul class="nav" role="menubar">
                    <li role="menuitem">
                        <!--Ссылки на различные страницы-->
                        <a href="shop.php">Меню</a>
                            <div class="mega-menu" aria-hidden="true" role="menu">
                                <div class="nav-column">
                                    <ul>
                                        <li role="menuitem"><a href="massages.php">Массажи</a></li>
                                        <li role="menuitem"><a href="china-massages.php">Китайские массажи</a></li>
                                        <li role="menuitem"><a href="thai-massages.php">Тайские массажи</a></li>
                                        <li role="menuitem"><a href="bali-massages.php">Балийские массажи</a></li>
                                    </ul>
                                </div>
                                <div class="nav-column">
                                    <ul>
                                        <li role="menuitem"><a href="pilling.php">Пилинги</a></li>
                                        <li role="menuitem"><a href="wraps.php">Обертывания</a></li>
                                        <li role="menuitem"><a href="special_offers.php">Специальное предложение</a></li>
                                        <li role="menuitem"><a href="gift_vouchers.php">Подарочные сертификаты</a></li>
                                    </ul>
                                </div>
                            </div>
                    </li>
                    <li role="menuitem"><a href="certificate.php">Сертификаты</a></li>
                    <li role="menuitem"><a href="apartments.php">Апартаменты</a></li>
                    <li role="menuitem"><a href="salons.php">Салоны</a></li>
                    <li role="menuitem"><a href="action.php">Акции</a></li>
                    <li role="menuitem"><a href="orders.php">Заказы</a></li>
                    <li role="menuitem"><a href="contact.php">Контакты</a></li>
                </ul>
            </div>

            <!--Иконки поиска, пользователя и корзины-->

            <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>

            <?php
if(isset($_SESSION['user_email']) && $_SESSION['user_email']){
?>
<div id="user-btn" class="fas fa-user"></div>
            <!--работа корзины-->
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

        <!--данные пользователя и кнопка выхода-->

         <div class="user-box">
            <p>имя: <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email: <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">выход</a>

            </div>
<?php
}
else{
?>
<?php
}

?>
         </div>
      </div>
   </div>

</header>