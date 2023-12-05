<?php require('connection.php') ?>
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
          <a href="#" class="active">
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
    <nav>
      <div class="sidebar-button">
        <span class="dashboard">Dashboard</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Pending</div>
            <?php
            $total_pending=0;
            $select_pending=" SELECT * FROM `orders` WHERE payment_status = 'pending' ";
            $result=mysqli_query($conn,$select_pending);
           /* while($res_fetch=mysqli_fetch_assoc($result))
            {
              $total_pending += $res_fetch['total_price'];
            }*/
            $total_pending=mysqli_num_rows($result);
            ?>
            <h3><?=$total_pending; ?></h3>
          
            <a href="admin_total_order.php">see order</a>
          </div> 
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Completed</div>
            <?php
            $total_completed=0;
            $select_completed=" SELECT * FROM `myorder` WHERE `order_status` = 'completed' ";
            $result=mysqli_query($conn,$select_completed);
           /* while($res_fetch=mysqli_fetch_assoc($result))
            {
              $total_completed += $res_fetch['total_price'];
            }*/
            $total_completed=mysqli_num_rows($result);
            ?>
            <h3><?=$total_completed; ?></h3>
     
            <a href="admin_total_order.php">see order</a>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Product Added</div>
            <?php
            $select_products=" SELECT * FROM `products` ";
            $result=mysqli_query($conn,$select_products);
            $number_of_products=mysqli_num_rows($result);
            ?>
            <h3><?=$number_of_products; ?></h3>
            <a href="admin_product1.php">see order</a>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Order placed</div>
            <?php
            $select_ordrs=" SELECT * FROM `myorder` ";
            $result=mysqli_query($conn,$select_ordrs);
            $number_of_orders=mysqli_num_rows($result);
            ?>
            <h3><?=$number_of_orders; ?></h3>
          
            <a href="admin_total_order.php">see order</a>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">users</div>
            <?php
            $select_accounts=" SELECT * FROM `users` where user_type='user' ";
            $result=mysqli_query($conn,$select_accounts);
            $number_of_accouts=mysqli_num_rows($result);
            ?>
            <h3><?=$number_of_accouts; ?></h3>
      
            <a href="admin_users.php">see accounts</a>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Messages</div>
            <?php
            $select_messages=" SELECT * FROM `message` ";
            $result=mysqli_query($conn,$select_messages);
            $number_of_messages=mysqli_num_rows($result);
            ?>
            <h3><?=$number_of_messages; ?></h3>
     
            <a href="admin_message.php">see messages</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>
</html>

