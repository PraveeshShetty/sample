<?php
require('connection.php');
if(isset($_POST['update_product']))
{
$image=$_FILES['image']['name'] ;
$image_size=$_FILES['image']['size'];
$image_tmp_name=$_FILES['image']['tmp_name'];
$image_error=$_FILES['image']['error'];

$image_folder = 'uploaded_img/'.$image;

$update_product ="UPDATE `products` SET `name` ='$_POST[name]', `category` ='$_POST[category]', `price` = '$_POST[price]' WHERE `id` = '$_GET[update]'";
mysqli_query($conn,$update_product);
echo "<script>
            alert('product updated successfully!');
      </script>";
      if(!empty($image))
      {
            $update_image ="UPDATE `products` SET `image` ='$image'  WHERE `id` ='$_POST[pid]'";
            $result=mysqli_query($conn,$update_image);
   
            if($result)
            {
               move_uploaded_file($image_tmp_name, $image_folder);
               unlink('uploaded_img/'.$_POST['old_image']);
            }
         
      }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="aa.css">

</head>
<body>
<section class="update-product">

   <h1 class="title">update product</h1>   
   <?php
      $select_products="SELECT * FROM `products` WHERE `id`='$_GET[update]'";
      $result=mysqli_query($conn,$select_products);
      if(mysqli_num_rows($result)>0)
      {
         while($fetch_products =mysqli_fetch_assoc($result))
         { 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <img src="<?= $fetch_products['image']; ?>" alt="">
      <input type="text" name="name" placeholder="enter product name" required class="box" value="<?= $fetch_products['name']; ?>">
      <input type="number" name="price" min="0" placeholder="enter product price" required class="box" value="<?= $fetch_products['price']; ?>">
      <select name="category" class="box" required>
         <option selected><?= $fetch_products['category']; ?></option>
         <option value="soups">soups</option>
                <option value="mains">mains</option>
                <option value="starters">starters</option>
                <option value="fastfood">fastfood</option>
                <option value="pizza">pizza</option>
                <option value="juices">juices</option>
      </select>
       <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <div class="flex-btn">
         <input type="submit" class="btn" value="update product" name="update_product">
         <a href="admin_product1.php" class="option-btn">go back</a>
      </div>
   </form>

   <?php
         }
      }
      else
      {
         echo '<p class="empty">no products found!</p>';
      }
   ?>
</section>

</body>
</html>