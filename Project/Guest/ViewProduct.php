<?php
include("../Assets/Connection/Connection.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View Product</title>
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

        .btn-success {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
        }

        .btn-success:hover {
            background-color: #218838;
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
        <table width="392" border="1">
            <tr>
                <th width="17" scope="row"><div align="center">#</div></th>
                <td width="48"><div align="center">Product</div></td>
                <td width="31"><div align="center">Price</div></td>
                <td width="36"><div align="center">Photo</div></td>
                <td width="56"><div align="center">Category</div></td>
                <td width="76"><div align="center">Subcategory</div></td>
                <td width="82"><div align="center">Action</div></td>
            </tr>
            <?php
            $i=0;
            $selQry="Select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id inner join tbl_category c on  c.category_id=s.category_id where s.subcategory_id=".$_GET['sid'] ;
            $row=$con->query($selQry);

            while($data=$row->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <th scope="row"><?php echo $i ?></th>
                <td><?php echo $data['product_name']?></td>
                <td><?php echo $data['product_price']?></td>
                <td><img src="../Assets/Files/Seller/Product/<?php echo $data['product_photo']?>" width="75" height="75" /></td>
                <td><?php echo $data['category_name']?></td>
                <td><?php echo $data['subcategory_name']?></td>
                <td>
                    <a href="NewLogin.php" onclick="addCart('<?php echo $data['product_id']; ?>')" class="btn-success">Add to Cart</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </form>
</body>
</html>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
   function addCart(id) {
       $.ajax({
           url: "../Assets/AjaxPages/AjaxAddCart.php?id=" + id,
           success: function(response) {
               if (response.trim() === "Added to Cart") {
                   $("div.success").fadeIn(300).delay(1500).fadeOut(400);
               } else if (response.trim() === "Already Added to Cart") {
                   $("div.warning").fadeIn(300).delay(1500).fadeOut(400);
               } else {
                   $("div.failure").fadeIn(300).delay(1500).fadeOut(400);
               }
           }
       });
   }
</script>


