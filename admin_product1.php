
<?php
require('connection.php');
  
if(isset($_GET['delete']))
{
  $query="SELECT `image` FROM `products` WHERE `id`='$_GET[delete]' ";
  $select_delete_image=mysqli_query($conn,$query);
  $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
  unlink('uploaded_img/'.$fetch_delete_image['image']);
  $delete_products = "DELETE FROM `products` WHERE `id` ='$_GET[delete]' ";
  $result=mysqli_query($conn,$delete_products);
  $delete_cart = "DELETE FROM `cart` WHERE pid = '$_GET[delete]'";
  $result=mysqli_query($conn,$delete_products);
  header('location:admin_product1.php');

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="aa.css">

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

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   <div class="home-content">             
  <section class="add-products">
<div class="container">

   <div class="admin-product-form-container">

      <form action="admin_add.php" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <select name="category" class="box" required>
                <option value="" selected disabled>select category</option>
                <option value="soups">soups</option>
                <option value="mains">mains</option>
                <option value="starters">starters</option>
                <option value="fastfood">fastfood</option>
                <option value="pizza">pizza</option>
                <option value="juices">juices</option>
              </select>
         
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td> <img style="width:100px" src="<?= $row['image']; ?>" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td>
               <a href="admin_update_products.php?update=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin_product1.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>