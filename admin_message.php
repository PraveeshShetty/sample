<?php require('connection.php');

if(isset($_GET['delete']))
{

$delete_id = $_GET['delete'];
$delete_message = "DELETE FROM `message` WHERE `id` ='$_GET[delete]'";
mysqli_query($conn,$delete_message);
header('location:admin_message.php');

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
  <h1 class="title" >Messages</h1>
  <section class="placed-orders">

<div class="box-container">
   
   <?php
      $select_message ="SELECT * FROM `message`";
      $result=mysqli_query($conn,$select_message);
      if(mysqli_num_rows($result)>0)
      {
         while($fetch_message = mysqli_fetch_assoc($result))
         {
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_message['user_id']; ?></span> </p>
      <p> name : <span><?= $fetch_message['name']; ?></span> </p>
      <p> number : <span><?= $fetch_message['number']; ?></span> </p>
      <p> email : <span><?= $fetch_message['email']; ?></span> </p>
      <p> message : <span><?= $fetch_message['message']; ?></span> </p>
      <a href="?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
   ?>

   </div>

    </section>
    </section>

</body>
</html>
    