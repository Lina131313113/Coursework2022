<?php
include 'config.php';
session_start();

$page_title = 'Салоны';
$page_style = 'admin';
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_salon'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $info = $_POST['info'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_salon_name = mysqli_query($conn, "SELECT name FROM `salons` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_salon_name) > 0){
      $message[] = 'название апартамент уже добавлено';
   }else{
      $add_salon_query = mysqli_query($conn, "INSERT INTO `salons`(name, info, image) VALUES('$name', '$info', '$image')") or die('query failed');

      if($add_salon_query){
         if($image_size > 2000000){
            $message[] = 'размер изображения слишком большой';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'апартаменты успешно добавлены!';
         }
      }else{
         $message[] = 'апартаменты не могут быть добавлены!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `salons` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `salons` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_salons.php');
}

if(isset($_POST['update_salon'])){

   $update_a_id = $_POST['update_a_id'];
   $update_name = $_POST['update_name'];
   $update_info = $_POST['update_info'];

   mysqli_query($conn, "UPDATE `salons` SET name = '$update_name', info = '$update_info' WHERE id = '$update_a_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'размер файла изображения слишком велик';
      }else{
         mysqli_query($conn, "UPDATE `salons` SET image = '$update_image' WHERE id = '$update_a_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_salons.php');

}

?>

<?php include 'layouts/head.php'; ?>
<?php include 'layouts/admin_header.php'; ?>

<section class="add-products">

   <h1 class="title">салоны</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>добавить салоны</h3>
      <input type="text" name="name" class="box" placeholder="введите название салона" required>
      <input type="text" name="info" class="box" placeholder="введите описание салона" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="добавить салон" name="add_salon" class="btn">
   </form>

</section>

<section class="show-salons">

   <div class="box-container">

      <?php
         $select_salons = mysqli_query($conn, "SELECT * FROM `salons`") or die('query failed');
         if(mysqli_num_rows($select_salons) > 0){
            while($fetch_salons = mysqli_fetch_assoc($select_salons)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_salons['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_salons['name']; ?></div>
         <div class="info"><?php echo $fetch_salons['info']; ?></div>
         <a href="admin_salons.php?update=<?php echo $fetch_salons['id']; ?>" class="option-btn">обновить</a>
         <a href="admin_salons.php?delete=<?php echo $fetch_salons['id']; ?>" class="delete-btn" onclick="return confirm('delete this salon?');">удалить</a>
      </div>
      <?php
         }
      }else{
        echo '<p class="empty">еще не добавлено салонов!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `salons` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_a_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter salon name">
      <input type="text" name="update_info" value="<?php echo $fetch_update['info']; ?>" class="box" required placeholder="enter salon info">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="обновить" name="update_salon" class="btn">
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