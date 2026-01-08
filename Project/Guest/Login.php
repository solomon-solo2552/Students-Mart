<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_login"]))
{
	$Email=$_POST["txt_email"];
	$Password=$_POST["txt_password"];
	
	
	$selQry="Select * from tbl_newuser where user_email='".$Email."' and user_password='".$Password."'";
	$row=$con->query($selQry);
	
	$selQry1="Select * from tbl_admin where admin_email='".$Email."' and admin_password='".$Password."'";
	$row1=$con->query($selQry1);
	
	$selQry2="Select * from tbl_seller where seller_email='".$Email."' and seller_password='".$Password."'";
	$row2=$con->query($selQry2);
	
	if($data=$row->fetch_assoc())
	{
		$_SESSION['uid']=$data['user_id'];
		$_SESSION['uname']=$data['user_name'];
		header("location:../User/HomePage.php");
	}
	else if($data1=$row1->fetch_assoc())
	{
		$_SESSION['aid']=$data1['admin_id'];
		$_SESSION['aname']=$data1['admin_name'];
		header("location:../Admin/HomePage.php");
	}
	else if($data2=$row2->fetch_assoc())
	{
		$_SESSION['sid']=$data2['seller_id'];
		$_SESSION['sname']=$data2['seller_name'];
		header("location:../Seller/HomePage.php");
	}
	else
	{
		echo "Invalid Login";
	}
}
?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_login" id="btn_login" value="Login" />
      </div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><a href="NewUser.php">New User</a></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><a href="NewSeller.php">New Seller</a></div></td>
    </tr>
  </table>
</form>
</body>
</html>