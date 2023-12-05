<?php require('connection.php');

if(isset($_POST['update_order']))
{

$update_orders = "UPDATE `orders` SET `payment_status` = '$_POST[update_payment]' WHERE `id` ='$_POST[order_id]'";
mysqli_query($conn,$update_orders);
echo "<script>
            alert('payment has been updated!');
      </script>";

}

if(isset($_GET['delete']))
{

$delete_id = $_GET['delete'];
$delete_orders = "DELETE FROM `orders` WHERE `id` ='$_GET[delete]'";
mysqli_query($conn,$delete_orders);
header('location:admin_orders.php');

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="aa.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Admin</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="aa.php" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="admin_product1.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Items</span>
          </a>
        </li>
        
        <li>
          <a href="admin_users.php">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Users</span>
          </a>
        </li>
        <li>
          <a href="admin_total_order.php">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Total order</span>
          </a>
        </li>
        <li>
          <a href="admin_message.php">
            <i class='bx bx-message' ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li class="log_out">
          <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
      <h1 class="title" >placed order</h1>
    
<section class="placed-orders">

<div class="box-container">

   <?php
      $select_orders ="SELECT * FROM `orders`";
      $result=mysqli_query($conn,$select_orders);
      if(mysqli_num_rows($result)>0)
      {
         while($fetch_orders = mysqli_fetch_assoc($result))
         {
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> total products : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> total price : <span>₹<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="POST">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="update_payment" class="drop-down">
            <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="pending">pending</option>
            <option value="completed">completed</option>
         </select>
         <div class="flex-btn">
            <input type="submit" name="update_order" class="option-btn" value="update">
            <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
         </div>
      </form>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   ?>

</div>

</section>
  </section>
</body>
</html>

