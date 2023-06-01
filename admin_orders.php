<?php
include 'config.php';
session_start();

$page_title = 'Заказы';
$page_style = 'admin';
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'статус платежа обновлен!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<?php include 'layouts/head.php'; ?>
<?php include 'layouts/admin_header.php'; ?>

<section class="orders">

   <h1 class="title">размещенные заказы</h1>

   <div class="box-containerr">
      <table class="ikswebb">
               <thead>
                  <tr>
                     <th>Пользователь</th>
                     <th>Размещенный на</th>
                     <th>Имя</th>
                     <th>Номер</th>
                     <th>Еmail</th>
                     <th>Адрес</th>
                     <th>Всего продуктов</th>
                     <th>Итого</th>
                     <th>Способ оплаты</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody class="tbody">
               <?php
                  $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                  if(mysqli_num_rows($select_orders) > 0){
                     while($fetch_orders = mysqli_fetch_assoc($select_orders)){
               ?>
                  <tr>
                  <td><?php echo $fetch_orders['user_id']; ?></td>
                     <td><?php echo $fetch_orders['placed_on']; ?></td>
                     <td><?php echo $fetch_orders['name']; ?></td>
                     <td><?php echo $fetch_orders['number']; ?></td>
                     <td><?php echo $fetch_orders['email']; ?></td>
                     <td><?php echo $fetch_orders['address']; ?></td>
                     <td><?php echo $fetch_orders['total_products']; ?></td>
                     <td>₽<?php echo $fetch_orders['total_price']; ?>/-</td>
                     <td><?php echo $fetch_orders['method']; ?></td>
                     <td>
                        <form action="" method="post">
                           <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                           <select name="update_payment">

                              <option value="Рассматривается">Рассматривается</option>
                              <option value="Завершенный">Завершенный</option>
                           </select>
                           <input type="submit" value="Обновить" name="update_order" class="option-btn">
                           <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">Удалить</a>
                        </form>
                     </td>
                  </tr>
               <?php
               }
               ?>
            </tbody>
      </table>
      
      <?php
      }else{
        echo '<p class="empty-2">Заказов еще нет!</p>';
      }
      ?>
   </div>

</section>

<?php include 'layouts/footer.php'; ?>