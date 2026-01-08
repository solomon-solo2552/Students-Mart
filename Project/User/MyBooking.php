<?php
include("../Assets/Connection/Connection.php");
include('Head.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>My Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

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
</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <td><a href="HomePage.php">Home</a></td>
    <table width="200" border="1">
	<tr>
    <th scope="row" style="background-color: #333; color: white;"><div align="center">#</div></th>
    <td style="background-color: #333; color: white;"><div align="center">SELLER</div></td>
    <td style="background-color: #333; color: white;"><div align="center">PRODUCT</div></td>
    <td style="background-color: #333; color: white;"><div align="center">PRICE</div></td>
    <td style="background-color: #333; color: white;"><div align="center">PHOTO</div></td>
    <td style="background-color: #333; color: white;"><div align="center">QUANTITY</div></td>
    <td style="background-color: #333; color: white;"><div align="center">STATUS</div></td>
</tr>

        <?php
        $i = 0;
        $selQry = "select * from tbl_cart c inner join tbl_product p on c.product_id=p.product_id inner join tbl_seller s on  s.seller_id=p.seller_id inner join tbl_booking b on c.booking_id=b.booking_id where b.user_id='" . $_SESSION['uid'] . "'";
        $row = $con->query($selQry);

        while ($data = $row->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <th scope="row"><?php echo $i ?></th>
                <td><?php echo $data['seller_name'] ?></td>
                <td><?php echo $data['product_name'] ?></td>
                <td><?php echo $data['product_price'] ?></td>
                <td><img src="../Assets/Files/Seller/Product/<?php echo $data['product_photo'] ?>" width="75" height="75" /></td>
                <td><?php echo $data['cart_quantity'] ?></td>
                <td>
                    <?php
                    if ($data['booking_status'] == 1) {
                        echo "Payment Incomplete";
                    } else if ($data['booking_status'] == 2) {
                        echo "Payment Completed";
                    } else if ($data['booking_status'] == 3) {
                        echo "Packed";
                    } else if ($data['booking_status'] == 4) {
                        echo "Shipped";
                    } else if ($data['booking_status'] == 5) {
                        echo "Delivered";
                    } else if ($data['booking_status'] == 6) {
                        echo "Order Completed";
                        ?>
                        <a href="Rating.php?pid=<?php echo $data['product_id'] ?>" class="btn1">Rating</a> <br /> <br />
                        <a href="Complaints.php?cid=<?php echo $data['product_id'] ?>" class="btn1">Complaints</a>
                        <?php
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
