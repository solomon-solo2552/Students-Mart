<?php
include("../Assets/Connection/Connection.php");
include('Head.php');

if(isset($_GET["ppID"]))
{
    $upQry="update tbl_booking set booking_status='3' where booking_id='".$_GET["ppID"]."'";
    if($con->query($upQry))
    {
        ?>
        <script>
        alert('Packed');
        window.location="ViewUserBooking.php";
        </script>
        <?php
    }
}

if(isset($_GET["psID"]))
{
    $upQry="update tbl_booking set booking_status='4' where booking_id='".$_GET["psID"]."'";
    if($con->query($upQry))
    {
        ?>
        <script>
        alert('Shipped');
        </script>
        <?php
    }
}

if(isset($_GET["pdID"]))
{
    $upQry="update tbl_booking set booking_status='5' where booking_id='".$_GET["pdID"]."'";
    if($con->query($upQry))
    {
        ?>
        <script>
        alert('Delivered');
        </script>
        <?php
    }
}

if(isset($_GET["prID"]))
{
    $upQry="update tbl_booking set booking_status='6' where booking_id='".$_GET["prID"]."'";
    if($con->query($upQry))
    {
        ?>
        <script>
        alert('Order Completed');
        </script>
        <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style>
   

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #333;
        color: white;
        text-transform: uppercase;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    td {
        color: #333;
    }

    .header-cell {
        background-color: #333; /* Match header background */
        color: white; /* Match header text color */
        text-transform: uppercase; /* Uppercase for consistency */
    }

    .btn1 {
        background-color: #ffd700;
        color: black;
        padding: 10px 20px;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        display: inline-block;
    }

    .btn1:hover {
        background-color: #daa520;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View User Booking</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<td><a href="HomePage.php">Home</a></td>
  <table width="200" border="1">
    <tr>
      <th scope="row" class="header-cell"><div align="center">#</div></th>
      <td class="header-cell"><div align="center">User Name</div></td>
      <td class="header-cell"><div align="center">Contact</div></td>
      <td class="header-cell"><div align="center">Product</div></td>
      <td class="header-cell"><div align="center">Price</div></td>
      <td class="header-cell"><div align="center">Quantity</div></td>
      <td class="header-cell"><div align="center">Action</div></td>
    </tr>
    <?php
    $i=0;
    $selQry="select * from tbl_cart c inner join tbl_product p on c.product_id=p.product_id inner join tbl_seller s on  s.seller_id=p.seller_id inner join tbl_booking b on c.booking_id=b.booking_id inner join tbl_newuser u on u.user_id=b.user_id where p.seller_id='".$_SESSION['sid']."'" ;
$row=$con->query($selQry);

    while($data=$row->fetch_assoc())
    {
        $i++;
        ?>
    <tr>
      <th scope="row"><?php echo $i ?></th>
      <td><?php echo $data['user_name']?></td>
      <td><?php echo $data['user_contact']?></td>
      <td><?php echo $data['product_name']?></td>
      <td><?php echo $data['product_price']?></td>
      <td><?php echo $data['cart_quantity']?></td>
      <td>
      <?php
      if($data['booking_status']==1)
      {
         echo "Payment Incomplete";
      }
      else if($data['booking_status']==2)
      {
         echo "Payment Completed";
         ?>
         <a href="ViewUserBooking.php?ppID=<?php echo $data['booking_id']?>" class="btn1">Packed</a>
         <?php
         
      }
      else if($data['booking_status']==3)
      {
         ?>
         <a href="ViewUserBooking.php?psID=<?php echo $data['booking_id']?>" class="btn1">Shipped</a>
         <?php
      }
      else if($data['booking_status']==4)
      {
         ?>
         <a href="ViewUserBooking.php?pdID=<?php echo $data['booking_id']?>" class="btn1">Delivered</a>
         <?php
      }
      else if($data['booking_status']==5)
      {
         ?>
         <a href="ViewUserBooking.php?prID=<?php echo $data['booking_id']?>" class="btn1">Order Complete</a>
         <?php
      }
      else
      {
          echo "Completed";
      }
      ?>
      </td>
    </tr>
    <?php
    }
    ?>
  </table>
</form>
</body>
</html>
<?php
include('Foot.php');
?>
