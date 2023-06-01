<?php
include 'config.php';
session_start();

$page_title = 'Салоны';
$page_style = 'user';
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $apartament_name = $_POST['salon_name'];
   $apartament_info = $_POST['salon_info'];
   $apartament_image = $_POST['salon_image'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$salon_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'уже добавлены в корзину!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, info, image) VALUES('$user_id', '$salon_name', '$salon_info', '$salont_image')") or die('query failed');
      $message[] = 'товар добавлен в корзину!';
   }

}

?>

<?php include 'layouts/head.php'; ?>
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>Салоны</h3>
   <p> <a href="index.php">Главная</a> / Салоны </p>
</div>

<section class="salons">
   
<h1 class="title-2">салоны</h1>

   <div class="salon-title">
      <h2>Наши Салоны</h2>
      <hr size="2" class="hrr">
   </div>

   <div class="box-container d-flex">

      <?php  
         $select_salons = mysqli_query($conn, "SELECT * FROM `salons`") or die('query failed');
         if(mysqli_num_rows($select_salons) > 0){
            while($fetch_salons = mysqli_fetch_assoc($select_salons)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_salons['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_salons['name']; ?></div>
      <div class="info"><?php echo $fetch_salons['info']; ?></div>
      <input type="hidden" name="apartament_name" value="<?php echo $fetch_salons['name']; ?>">
      <input type="hidden" name="apartament_info" value="<?php echo $fetch_salons['info']; ?>">
      <input type="hidden" name="apartament_image" value="<?php echo $fetch_salons['image']; ?>">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty-4">еще не добавлено салонов!</p>';
      }
      ?>
   </div>

</section>

<?php include 'layouts/footer.php'; ?>