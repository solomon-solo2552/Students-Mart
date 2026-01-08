<?php
include("../Assets/Connection/Connection.php");
include('Head.php');

$selQry = "Select * from tbl_newuser where user_id='" . $_SESSION['uid'] . "'";
$row = $con->query($selQry);
$data = $row->fetch_assoc();
$data_dbpassword = $data['user_password'];

if (isset($_POST["btn_changepassword"])) {
    $OldPassword = $_POST['txt_oldpassword'];
    $NewPassword = $_POST['txt_newpassword'];
    $RetypePassword = $_POST['txt_retypepassword'];
    
    if ($data_dbpassword == $OldPassword) {
        $upqry = "update tbl_newuser set user_password='" . $NewPassword . "' where user_id='" . $_SESSION['uid'] . "'";
        if ($NewPassword == $RetypePassword) {
            if ($con->query($upqry)) {
                ?>
                <script>
                    alert('Updated');
                    window.location = "ChangePassword.php";
                </script>
                <?php
            }
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #ffd700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td {
            padding: 10px;
            color: #000000;
        }

        input[type="text"] {
            width: 100%;
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

        label {
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Change Password</h2>
    <form id="form1" name="form1" method="post" action="">
        <table>
            <tr>
                <td>Old Password</td>
                <td><input type="text" name="txt_oldpassword" id="txt_oldpassword" /></td>
            </tr>
            <tr>
                <td>New Password</td>
                <td><input type="text" name="txt_newpassword" id="txt_newpassword" /></td>
            </tr>
            <tr>
                <td>Re-Type Password</td>
                <td><input type="text" name="txt_retypepassword" id="txt_retypepassword" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="btn_changepassword" id="btn_changepassword" value="Change Password" />
                        <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" />
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
<?php
include('Foot.php');
?>
