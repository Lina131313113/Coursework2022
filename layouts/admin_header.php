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

<header class="header">
   <div class="flex">
      <a href="admin_page.php" class="logo">Панель<span>Админа</span></a>
      <div class="menu-wrapper" role="navigation">
         <ul class="nav" role="menubar">
            <li role="menuitem"><a href="admin_page.php">Главная</a></li>
            <li role="menuitem"><a href="admin_products.php">Меню</a></li>
            <li role="menuitem"><a href="admin_apartaments.php">Апартаменты</a></li>
            <li role="menuitem"><a href="admin-certificates.php">Сертификаты</a></li>
            <li role="menuitem"><a href="admin_salons.php">Салоны</a></li>
            <li role="menuitem"><a href="admin_orders.php">Заказы</a></li>
            <li role="menuitem"><a href="admin_users.php">Пользователи</a></li>
            <li role="menuitem"><a href="admin_contacts.php">Сообщения</a></li>
         </ul>
      </div>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>имя: <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">Выход</a>
      </div>
   </div>
</header>