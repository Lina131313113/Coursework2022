<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];
$page_title = 'Меню';
$page_style = 'user';

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

<?php include 'layouts/head.php'; ?>
<?php include 'layouts/header.php'; ?>

<div class="heading">
   <h3>апартаменты</h3>
   <p> <a href="index.php">Главная</a> / Апартаменты </p>
</div>


<section class="products">
   <div id="piece-search">

      <ul class="sort-by d-flex justify-center mb-2">
         <li>
            <input class="search form-control mr-2" placeholder="Поиск...">
            <label for="minPrice">цена:</label>
            <input type="number" class="form-control" placeholder="мин" id="minPrice" value="3000" />
            <label for="minPrice"> - </label>
            <input type="number" class="form-control" placeholder="макс" id="maxPrice" value="15000" />
         </li>
      </ul>

      <div class="d-flex justify-center mb-2">
         <div class="mr-2"><label><input type="radio" name="category" value="all" checked> показать все</label></div>
         <div class="mr-2"><label><input type="radio" name="category" value="china"> Китайские массажи</label></div>
         <div class="mr-2"><label><input type="radio" name="category" value="bali"> Балийские массажи</label></div>
         <div class="mr-2"><label><input type="radio" name="category" value="thai"> Тайские массажи</label></div>
         <div class="mr-2"><label><input type="radio" name="category" value="pilling"> Пилинги</label></div>
         <div class="mr-2"><label><input type="radio" name="category" value="wraps"> Обертывания</label></div>
      </div>
      

      <ul class="box-container list">
            <?php  
                  $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                  if(mysqli_num_rows($select_products) > 0){
                     while($fetch_products = mysqli_fetch_assoc($select_products)){
               ?>
            <li class="item">
               <form action="" method="post" class="box">
                  <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <div class="ammount"><span class="price"><?php echo $fetch_products['price']; ?></span>₽</div>
                  <div>Категория: <span class="category"><?php echo $fetch_products['classified']; ?></span></div>
                  <input type="number" class="qty" name="product_quantity" min="1" value="1">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <div class="d-flex justify-center">
                     <input type="submit" value="добавить в корзину" name="add_to_cart" class="btn-2">
                  </div>
               </form>
            </li>
               <?php
                  }
               }else{
                  echo '<p class="empty">еще не добавлено услуг!</p>';
               }
               ?>
      </ul>
   </div>




      


</section>


<script src="js/list.min.js"></script>
<script src="js/jquery.min.js"></script>
<script>
   let options = {
  valueNames: ['category', 'price', 'name']
};

let featureList = new List('piece-search', options);




$('#minPrice, #maxPrice').on('change paste input', function() {
   let minPrice = parseInt($('#minPrice').val(), 10);
   let maxPrice = parseInt($('#maxPrice').val(), 10);
   let category = $('[name="category"]:checked').val();
  featureList.filter(function(item) {
    if(category === 'all') {
      if (item.values().price >= minPrice && item.values().price <= maxPrice) {
        return true;
      } else {
        return false;
      }
    } else {
      if (item.values().price >= minPrice && item.values().price <= maxPrice && item.values().category === category) {
        return true;
      } else {
        return false;
      }
    }
    
  });
  return false;
});



$('[name="category"]').on('change', function() {
   let minPrice = parseInt($('#minPrice').val(), 10);
   let maxPrice = parseInt($('#maxPrice').val(), 10);
   let category = $('[name="category"]:checked').val();
  featureList.filter(function(item) {
    if(category === 'all') {
      if (item.values().price >= minPrice && item.values().price <= maxPrice) {
        return true;
      } else {
        return false;
      }
    } else {
      if (item.values().price >= minPrice && item.values().price <= maxPrice && item.values().category === category) {
        return true;
      } else {
        return false;
      }
    }
    
  });
  return false;
});
</script>

<?php include 'layouts/footer.php'; ?>