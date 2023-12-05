<?php
    session_start();
    require('../viproject/signinup/connection.php');

?>
<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
  margin-left: 8%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
img{
    height:40px;
    width:50px;
}
</style>
</head>
<body>

<center><h1>My orders</h1></center>

<table id="customers">
<thead>
    <tr>
    <th>Name</th>
    <th>Quantity</th>
    <th>Username</th>
    <th>Address</th>
    <th>Price</th>
    <th>Image</th>
    <th>Total Price</th>
    <th>Order_Status</th>
    </tr>
</thead>

<?php
    $query="SELECT * from `myorder`";
    $res=mysqli_query($conn,$query);
    if($res)
        {
            while($row=mysqli_fetch_assoc($res))
                {
                    $id=$row['order_id'];
                    $query2="SELECT * from `orders` where `id`='$id'";
                    $res1=mysqli_query($conn,$query2);
                    $row1=mysqli_fetch_assoc($res1);
                    $uid=$row1['name'];
                    $add=$row1['address'];
                    ?>
                        <form action="" method="post">
                            <tr>
                            <td><?php echo $row['p_name']; ?></td>
                            <td><?php echo $row['p_qty']; ?></td>
                            <td><?php echo $uid; ?></td>
                            <td><?php echo $add; ?></td>
                            <td>Rs.<?php echo $row['p_price']; ?></td>
                            <td><img src="../adminex/<?php echo $row['p_image']; ?>"></td>
                            <td>Rs.<?php echo $row['total_price'];?></td>
                            <td><select name="order_status">
                                <option value="" disabled selected><?php echo $row['order_status']; ?></option>
                                <option value="pending" >pending</option>
                                <option value="completed" >completed</option>
                            </select>
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Update" name="update">
                        </td>
                            </tr>
                            </form>
                        </tbody>
                <?php }
        }
    else
        {
            echo "<script>
            alert('Cannot run query');
            window.location.href='login.php';
                </script>
      ";
        }
?>
</table>
</body>
</html>
<?php
    if(isset($_POST['update']))
        {
            $query="UPDATE `myorder` set `order_status`='$_POST[order_status]' where `id`='$_POST[id]'";
            $res=mysqli_query($conn,$query);
            if($query)
                {
                    echo "<script>
                    alert('Updated successfully');
                    window.location.href='admin_total_order.php';
                        </script>
              ";
                }
            else
                {
                    echo "<script>
                    alert('Cannot run query');
                    window.location.href='admin_total_order.php';
                        </script>
              ";
                }
        }
?>


