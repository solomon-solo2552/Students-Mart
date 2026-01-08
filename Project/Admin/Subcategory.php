<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if (isset($_POST['btn_save'])) {
    $subcategory = $_POST["txt_sub"];
    $category = $_POST["sel_category"];
    $Photo=$_FILES["file_photo"]['name'];
    $temp=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/Photo/'.$Photo);
    $id = $_POST['txtid'];
    if ($id == '') {
        $insqry = "insert into tbl_subcategory(subcategory_name,category_id,subcategory_photo)values('" . $_POST["txt_sub"] . "','" . $_POST["sel_category"] . "','".$Photo."')";
        if ($con->query($insqry)) {
            ?>
            <script>
                alert('Inserted');
                window.location = "Subcategory.php";
            </script>
            <?php
        }
    } else {
        $upqry = "update tbl_subcategory set subcategory_name='" . $subcategory . "',category_id='" . $category . "' where subcategory_id='" . $id . "'";
        if ($con->query($upqry)) {
            ?>
            <script>
                alert('Updated');
                window.location = "Subcategory.php";
            </script>
            <?php
        }
    }
}

if (isset($_GET["delID"])) {
    $delQry = "delete from tbl_subcategory where subcategory_id='" . $_GET["delID"] . "'";
    if ($con->query($delQry)) {
        ?>
        <script>
            alert('Deleted');
            window.location = "Subcategory.php";
        </script>
        <?php
    }
}

$did = $dis = "";
if (isset($_GET['eid'])) {
    $selQry = "Select * from tbl_subcategory where subcategory_id='" . $_GET['eid'] . "'";
    $datadis = $con->query($selQry);
    $rowdis = $datadis->fetch_assoc();
    $dis = $rowdis['subcategory_name'];
    $did = $rowdis['subcategory_id'];
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Subcategory</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            /* margin: 0;
            padding: 20px; */
        }

        .container {
            max-width: 700px;
            margin: 20px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            color: #bb86fc;
            margin-bottom: 20px;
            font-size: 24px;
        }

        a {
            color: #bb86fc;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #424242;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #2c2c2c;
        }

        td {
            background-color: #1f1f1f;
        }

        input[type="text"], select {
            width: 90%;
            padding: 8px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid #424242;
            border-radius: 4px;
            background-color: #2c2c2c;
            color: #e0e0e0;
        }

        input[type="submit"], input[type="reset"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #bb86fc;
            color: #121212;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #3700b3;
        }

        .action-links a {
            margin: 0 5px;
            color: #bb86fc;
        }

        .action-links a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>
<div class="container">
    <h1>Subcategory Management</h1>
    <a href="HomePage.php">Home</a>
    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
        <table>
            <tr>
                <th>Category</th>
                <td>
                    <select name="sel_category" id="sel_category">
                        <option>--Select--</option>
                        <?php
                        $sel = "select * from tbl_category";
                        $row = $con->query($sel);
                        while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['category_id'] ?>"><?php echo $data['category_name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Subcategory</th>
                <td>
                    <input type="text" name="txt_sub" id="txt_sub" value="<?php echo $dis ?>" />
                    <input type="hidden" name="txtid" value="<?php echo $did ?>">
                </td>
            </tr>
            <tr>
        <th>Photo</th>
        <td><input type="file" name="file_photo" id="file_photo" /></td>
      </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_save" id="btn_save" value="Save" />
                    <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" />
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $sel = "select * from tbl_subcategory s inner join tbl_category c on s.category_id=c.category_id";
            $row = $con->query($sel);
            while ($data = $row->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['category_name'] ?></td>
                    <td><?php echo $data['subcategory_name'] ?></td>
                    <td><img src="../Assets/Files/Photo/<?php echo $data['subcategory_photo']?>"width="100px" height="100px" class="image-preview" /></td>
                    <td class="action-links">
                        <a href="Subcategory.php?delID=<?php echo $data['subcategory_id'] ?>">Delete</a>
                        <a href="Subcategory.php?eid=<?php echo $data['subcategory_id'] ?>">Edit</a>
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
include("Foot.php");
?>
