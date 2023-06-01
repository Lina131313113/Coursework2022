<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_apartament'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_apartament_name = mysqli_query($conn, "SELECT name FROM `apartaments` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_apartament_name) > 0){
      $message[] = 'название апартамент уже добавлено';
   }else{
      $add_apartament_query = mysqli_query($conn, "INSERT INTO `apartaments`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

      if($add_apartament_query){
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
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `apartaments` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `apartaments` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_apartaments.php');
}

if(isset($_POST['update_apartament'])){

   $update_a_id = $_POST['update_a_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `apartaments` SET name = '$update_name', price = '$update_price' WHERE id = '$update_a_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'размер файла изображения слишком велик';
      }else{
         mysqli_query($conn, "UPDATE `apartaments` SET image = '$update_image' WHERE id = '$update_a_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_apartaments.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Апартаменты</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'layouts/admin_header.php'; ?>

<!-- apartament CRUD section starts  -->

<section class="add-products">

   <h1 class="title">апартаменты</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>добавить апартаменты</h3>
      <input type="text" name="name" class="box" placeholder="введите название апартамент" required>
      <input type="number" min="0" name="price" class="box" placeholder="введите цену апартамент" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="добавить апартаменты" name="add_apartament" class="btn">
   </form>

</section>

<!-- apartament CRUD section ends -->

<!-- show apartaments  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_apartaments = mysqli_query($conn, "SELECT * FROM `apartaments`") or die('query failed');
         if(mysqli_num_rows($select_apartaments) > 0){
            while($fetch_apartaments = mysqli_fetch_assoc($select_apartaments)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_apartaments['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_apartaments['name']; ?></div>
         <div class="price">₽<?php echo $fetch_apartaments['price']; ?>/-</div>
         <a href="admin_apartaments.php?update=<?php echo $fetch_apartaments['id']; ?>" class="option-btn">обновить</a>
         <a href="admin_apartaments.php?delete=<?php echo $fetch_apartaments['id']; ?>" class="delete-btn" onclick="return confirm('delete this apartament?');">удалить</a>
      </div>
      <?php
         }
      }else{
        echo '<p class="empty">еще не добавлено апартамент!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `apartaments` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_a_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter apartament name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter apartament price">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="обновить" name="update_apartament" class="btn">
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







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>