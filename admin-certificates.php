<?php
include 'config.php';
session_start();

$page_title = 'Сертификаты';
$page_style = 'admin';
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_certificate'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_certificate_name = mysqli_query($conn, "SELECT name FROM `certificates` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_certificate_name) > 0){
      $message[] = 'название сертификата уже добавлено';
   }else{
      $add_certificate_query = mysqli_query($conn, "INSERT INTO `certificates`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

      if($add_certificate_query){
         if($image_size > 2000000){
            $message[] = 'размер изображения слишком большой';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'сертификат успешно добавлен!';
         }
      }else{
         $message[] = 'сертификат не может быть добавлен!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `certificates` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `certificates` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin-certificates.php');
}

if(isset($_POST['update_certificate'])){

   $update_a_id = $_POST['update_a_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `certificates` SET name = '$update_name', price = '$update_price' WHERE id = '$update_a_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'размер файла изображения слишком велик';
      }else{
         mysqli_query($conn, "UPDATE `certificates` SET image = '$update_image' WHERE id = '$update_a_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin-certificates.php');

}

?>

<?php include 'layouts/head.php'; ?>
<?php include 'layouts/admin_header.php'; ?>

<!-- certificate CRUD section starts  -->

<section class="add-products">

   <h1 class="title">сертификаты</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>добавить сертификат</h3>
      <input type="text" name="name" class="box" placeholder="введите название сертификата" required>
      <input type="number" min="0" name="price" class="box" placeholder="введите цену сертификата" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="добавить сертификат" name="add_certificate" class="btn">
   </form>

</section>

<!-- certificate CRUD section ends -->

<!-- show certificates  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_certificates = mysqli_query($conn, "SELECT * FROM `certificates`") or die('query failed');
         if(mysqli_num_rows($select_certificates) > 0){
            while($fetch_certificates = mysqli_fetch_assoc($select_certificates)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_certificates['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_certificates['name']; ?></div>
         <div class="price">₽<?php echo $fetch_certificates['price']; ?>/-</div>
         <a href="admin-certificates.php?update=<?php echo $fetch_certificates['id']; ?>" class="option-btn">обновить</a>
         <a href="admin-certificates.php?delete=<?php echo $fetch_certificates['id']; ?>" class="delete-btn" onclick="return confirm('delete this certificate?');">удалить</a>
      </div>
      <?php
         }
      }else{
        echo '<p class="empty">еще не добавлено сертификатов!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `certificates` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_a_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter certificate name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter certificate price">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="обновить" name="update_certificate" class="btn">
      <input type="reset" value="закрыть" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>

<?php include 'layouts/footer.php'; ?>