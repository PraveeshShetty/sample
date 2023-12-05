<?php
 require('connection.php') ;
 
 
if(isset($_GET['delete']))
{
  $delete_users = "DELETE FROM `users` WHERE `id` ='$_GET[delete]' ";
  $result=mysqli_query($conn,$delete_users);
  $delete_cart = "DELETE FROM `cart` WHERE `pid` = '$_GET[delete]'";
  $result=mysqli_query($conn,$delete_cart);
  header('location:admin_users.php');

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="aa.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
    <div class="table_section">
   
  <table>
              <thead>
                  <tr>
				
				<th>Name</th>
				<th>Email</th>
				<th>Password</th>
				<th>Action</th>
			
			</tr>
                  </thead>
                  <?php
                  $query="SELECT * FROM `users` WHERE `user_type`='user'";
                  $result=mysqli_query($conn,$query);
                  if(mysqli_num_rows($result)>0)
                  {
                    while($row=mysqli_fetch_assoc($result))
                    {
                      $id=$row['id'];
                      $name=$row['name'];
                      $email=$row['email'];
                      $password=$row['password'];
                      ?>

                      <tbody>
                    <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $password; ?></td>

                   <td>
                    <form action="" method="post">
                    <input type="hidden" name="email" value="<?php echo $email;?>">
                      <input type="submit" name="delete" value="Delete">
                      </form>
                  </td>
                  </tr>
                   
            <?php
                    }
                  }
                  else
                  {?>
                  <tr>
                    <td colspan=4>No records found</td>
                  </tr>
                  </tbody> </tbody>
                  <?php
                  }
                ?>
</table>
                </div>
                </div>
</setion>
<?php
if(isset($_POST['delete']))
                  {
                    $query="DELETE from `users` where `email`='$_POST[email]'";
                    if(mysqli_query($conn,$query))
                      {
                        echo "<script>
                        alert('Deleted successfully');
                        window.location.href='admin_users.php';
                        </script>";
                      }
                  }
?>
