<?php
include("../Assets/Connection/Connection.php");
if (isset($_POST["btn_submit"])) {
    $admin_name = $_POST["txt_name"];
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];
    $id = $_POST['txtid'];
    if ($id == '') {
        $insqry = "insert into tbl_admin(admin_name,admin_email,admin_password)values('" . $admin_name . "','" . $email . "','" . $password . "')";
        if ($con->query($insqry)) {
            ?>
            <script>
                alert('Registered');
                window.location = "Admin.php";
            </script>
            <?php
        }
    } else {
        $upqry = "update tbl_admin set admin_name='" . $admin_name . "',admin_email='" . $email . "',admin_password='" . $password . "' where admin_id='" . $id . "'";
        if ($con->query($upqry)) {
            ?>
            <script>
                alert('Updated');
                window.location = "Admin.php";
            </script>
            <?php
        }
    }
}
if (isset($_GET["delID"])) {
    $delQry = "delete from tbl_admin where admin_id='" . $_GET["delID"] . "'";
    if ($con->query($delQry)) {
        ?>
        <script>
            alert('Deleted');
            window.location = "Admin.php";
        </script>
        <?php
    }
}
$did = $dis = $dir = $dij = "";
if (isset($_GET['eid'])) {
    $selQry = "Select * from tbl_admin where admin_id='" . $_GET['eid'] . "'";
    $datadis = $con->query($selQry);
    $rowdis = $datadis->fetch_assoc();
    $dis = $rowdis['admin_name'];
    $dir = $rowdis['admin_email'];
    $dij = $rowdis['admin_password'];
    $did = $rowdis['admin_id'];
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #ffd700;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td, th {
            padding: 10px;
            text-align: center;
            color: #f8f8ff;
        }

        input[type="text"], input[type="password"] {
            width: calc(100% - 16px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"], input[type="reset"] {
            background-color: #ffd700;
            color: #000000;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #daa520;
        }

        a {
            color: #ffd700;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .action-links {
            display: flex;
            justify-content: space-around;
        }

        .table-header {
            background-color: #444;
        }

        .table-header th {
            color: #ffd700;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Admin Registration</h2>
    <td><a href="HomePage.php">Home</a></td>
    <form id="form1" name="form1" method="post" action="">
        <table border="1">  
            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="txt_name" id="txt_name" value="<?php echo $dis ?>" />
                    <input type="hidden" name="txtid" value="<?php echo $did ?>">
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="txt_email" id="txt_email" value="<?php echo $dir ?>" />
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="txt_password" id="txt_password" value="<?php echo $dij ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                    <input type="reset" name="btncancel" id="btncancel" value="Cancel" />
                </td>
            </tr>
        </table>
        <table border="1">
            <tr class="table-header">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $sel = "select * from tbl_admin";
            $row = $con->query($sel);
            while ($data = $row->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['admin_name'] ?></td>
                    <td><?php echo $data['admin_email'] ?></td>
                    <td><?php echo $data['admin_password'] ?></td>
                    <td class="action-links">
                        <a href="Admin.php?delID=<?php echo $data['admin_id'] ?>">Delete</a>
                        <a href="Admin.php?eid=<?php echo $data['admin_id'] ?>">Edit</a>
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
