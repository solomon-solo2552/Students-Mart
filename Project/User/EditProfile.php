<?php
include("../Assets/Connection/Connection.php");
include('Head.php');

$selQry = "Select * from tbl_newuser where user_id='" . $_SESSION['uid'] . "'";
$row = $con->query($selQry);
$data = $row->fetch_assoc();

if (isset($_POST["btn_edit"])) {
    $Name = $_POST["txt_name"];
    $Email = $_POST["txt_email"];
    $Contact = $_POST["txt_contact"];
    $Address = $_POST["txt_address"];

    $upqry = "update tbl_newuser set user_name='" . $Name . "',user_email='" . $Email . "',user_contact='" . $Contact . "',user_address='" . $Address . "' where user_id='" . $_SESSION['uid'] . "'";
    if ($con->query($upqry)) {
        ?>
        <script>
            alert('Updated');
            window.location = "EditProfile.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
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
            color: #f8f8ff;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #ffd700;
            color: #000000;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #daa520;
        }

        label {
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Edit Profile</h2>
    <form id="form1" name="form1" method="post" action="">
        <table>
            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="txt_name" id="txt_name" value="<?php echo $data['user_name'] ?>" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required />
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="txt_email" id="txt_email" value="<?php echo $data['user_email'] ?>" required />
                </td>
            </tr>
            <tr>
                <td>Contact</td>
                <td>
                    <input type="text" name="txt_contact" id="txt_contact" value="<?php echo $data['user_contact'] ?>" pattern="[7-9]{1}[0-9]{9}" 
                    title="Phone number with 7-9 and remaining 9 digit with 0-9" required />
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <textarea name="txt_address" id="txt_address" cols="45" rows="5" required><?php echo $data['user_address'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="btn_edit" id="btn_edit" value="Edit" />
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
