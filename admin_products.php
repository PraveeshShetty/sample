
<?php
require('connection.php');

if(isset($_POST['add_product']))
{


    $image=$_FILES['image']['name'] ;
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_error=$_FILES['image']['error'];


    $image_folder='uploaded_img/'.$image;
    $select_products=" SELECT * FROM `products` where 'name' ='$_POST[name]'";
    $result=mysqli_query($conn,$select_products);
    if(mysqli_num_rows($result)>0)
    {
        echo   
        "<script>
        alert('already exists');
        </script>";   
    }
    else
    {
        $insert_products="INSERT INTO `products`(`name`, `category`, `price`, `image`) VALUES ('$_POST[name]','$_POST[category]','$_POST[price]','$image')";        
        mysqli_query($conn,$insert_products);
        if($insert_products)
        {
            move_uploaded_file($image_tmp_name,$image_folder);
            echo 
            "<script>
            alert('new prodect added');
            header('admin_products.php');
            </script>";  
        }
    }
}  
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
  header('location:admin_products.php');

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="aa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
          <a href="admin_products.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Product</span>
          </a>
        </li>
        <li>
          <a href="admin_orders.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Order list</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Users</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Total order</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li class="log_out">
          <a href="#">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
<section class="home-section">
    <nav>
      <div class="sidebar-button">
        <span class="dashboard">ADD NEW PRODUCT</span>
      </div>
    </nav>

<div class="home-content">             
  <section class="add-products">
    <form action="admin_products.php" method="POST" enctype="multipart/form-data">
      <div class="flex">
        <div class="inputBox">
            <input type="text" name="name" class="box" required placeholder="enter product name">
              <select name="category" class="box" required>
                <option value="" selected disabled>select category</option>
                <option value="soups">soups</option>
                <option value="mains">mains</option>
                <option value="starters">starters</option>
                <option value="fastfood">fastfood</option>
                <option value="pizza">pizza</option>
                <option value="juices">juices</option>
              </select>
          </div>
          <div class="inputBox">
            <input type="number" min="0" name="price" class="box" required placeholder="enter product price">
            <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
          </div>
        </div>
          <input type="submit" class="btn" value="ADD PRODUCT" name="add_product">
      </form>

  </section>
   
    <section class="show-products">

            <h1 class="title">products added</h1>

          <div class="box-container">
          <?php
              $show_products = "SELECT * FROM `products`";
              $result=mysqli_query($conn,$show_products);
              if(mysqli_num_rows($result)>0)
                {
                  while($fetch_products=mysqli_fetch_assoc($result))
                    {  
            ?>
    <div class="box">
     
        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
        <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
        </div>
      <div class="name"><h3><?= $fetch_products['name']; ?></h3></div>
      <div class="price">₹<?= $fetch_products['price']; ?>/-</div>
      <div class="cat"><?= $fetch_products['category']; ?></div>
      <div class="flex-btn">
         <a href="admin_update_products.php?update=<?= $fetch_products['id']; ?>" class="update-btn">update</a>
         <a href="admin_products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">now products added yet!</p>';
   }
   ?>
   </div>
  </section>
  </div>
</section>


  
</body>
</html>
