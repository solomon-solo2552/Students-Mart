<?php
include("../Assets/Connection/Connection.php");
include('Head.php');

if (isset($_POST["btn_submit"])) {
    $stock = $_POST["txt_stockquantity"];
    $Product = $_GET["asID"];

    $insqry = "insert into tbl_stock(stock_quantity,stock_date,product_id) values('" . $stock . "', curdate(), '" . $Product . "')";
    if ($con->query($insqry)) {
        ?>
        <script>
            alert('Inserted');
            window.location="Product.php";
        </script>
        <?php
    }
}
if (isset($_GET["delID"])) {
    $delQry = "delete from tbl_stock where stock_id='" . $_GET["delID"] . "'";
    if ($con->query($delQry)) {
        ?>
        <script>
            alert('Deleted');
            window.location = "Product.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock Management</title>

<!-- Embedded CSS for styling -->
<style>
    

    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-top: 30px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    form {
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table, th, td {
        border: 1px solid #dddddd;
        padding: 10px;
    }

    th {
        background-color: #708090;
        color: white;
        text-align: center;
    }

    td {
        text-align: center;
        color: #333;
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .action-links a {
        text-decoration: none;
        padding: 8px 12px;
        background-color: #ff6b6b;
        color: white;
        border-radius: 5px;
        margin: 5px;
        display: inline-block;
        transition: background-color 0.3s;
    }

    .action-links a:hover {
        background-color: #ff4b4b;
    }
</style>

</head>

<body>

<div class="container">
    <h1>Stock Management</h1>
    <form id="form1" name="form1" method="post" action="">
        <table>
            <tr>
                <td scope="row"><div align="center">Stock Quantity</div></td>
                <td><input type="text" name="txt_stockquantity" id="txt_stockquantity" /></td>
            </tr>
            <tr>
                <td colspan="2" scope="row"><div align="center">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                </div></td>
            </tr>
        </table>
        <table>
            <tr>
                <th scope="row"><div align="center">#</div></th>
                <th><div align="center">Quantity</div></th>
                <th><div align="center">Date</div></th>
                <th><div align="center">Action</div></th>
            </tr>
            <?php
            $i = 0;
            $sel = "select * from tbl_stock where product_id=" . $_GET["asID"];
            $row = $con->query($sel);
            while ($data = $row->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <td scope="row"><?php echo $i ?></td>
                    <td><?php echo $data['stock_quantity'] ?></td>
                    <td><?php echo $data['stock_date'] ?></td>
                    <td class="action-links">
                        <a href="Stock.php?delID=<?php echo $data['stock_id'] ?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </form>
</div>

</body>
</html>
<?php
include('Foot.php');
?>
