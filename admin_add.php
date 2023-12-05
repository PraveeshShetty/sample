
<?php
require('connection.php');

if(isset($_POST['add_product']))
{


    $image=$_FILES['product_image']['name'] ;
    $image_size=$_FILES['product_image']['size'];
    $image_tmp_name=$_FILES['product_image']['tmp_name'];
    $image_error=$_FILES['product_image']['error'];


    $image_folder='uploaded_img/'.$image;
    $select_products=" SELECT * FROM `products` where `name` ='$_POST[product_name]'";
    $result=mysqli_query($conn,$select_products);
    if(mysqli_num_rows($result)>0)
    {
        echo   
        "<script>
        alert('already exists');
        window.location.href='admin_product1.php';
        </script>";   
    }
    else
    {
        $insert_products="INSERT INTO `products`(`name`, `category`, `price`, `image`) VALUES ('$_POST[product_name]','$_POST[category]','$_POST[product_price]','$image_folder')";        
        mysqli_query($conn,$insert_products);
        if($insert_products)
        {
            move_uploaded_file($image_tmp_name,$image_folder);
            echo 
            "<script>
            alert('new prodect added');
            window.location.href='admin_product1.php';
            </script>";  
        }
    }
}