
<?php
session_start();
include("../Assets/Connection/Connection.php");


if(isset($_POST['btn_submit'])){
    $pass=$_POST['txt_pass'];
    $cpass=$_POST['txt_cpass'];
    if($pass==$cpass){
        if(isset($_SESSION['ruid'])){ //User
            $updQry="update tbl_user set user_password='".$pass."' where user_id=".$_SESSION['ruid'];
            if($con->query($updQry)){
                ?>
                <script>
                    alert("Password Updated")
                    window.location="../Logout.php"
                    </script>
                <?php
            }
        }
        else if(isset($_SESSION['rsid'])){ //Seller
            $updQry="update tbl_seller set seller_password='".$pass."' where seller_id=".$_SESSION['rsid'];
            if($con->query($updQry)){
                ?>
                <script>
                    alert("Password Updated")
                    window.location="../Logout.php"
                    </script>
                <?php
            }
        }
      
        
        else{
            ?>
            <script>
                alert('Something went wrong')
                    window.location="../Logout.php"
                </script>
            <?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <table border='1'>
            <tr>
                <td>New Password</td>
                <td><input type="password" name="txt_pass" id=""></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="txt_cpass" id=""></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="btn_submit" value="Change Password"></td>
                
            </tr>
        </table>
    </form>
</body>
</html>
