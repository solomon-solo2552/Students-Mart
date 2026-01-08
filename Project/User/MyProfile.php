<?php
include("../Assets/Connection/Connection.php");
include('Head.php');

$selQry="Select * from tbl_newuser n inner join tbl_place p on n.place_id=p.place_id inner join tbl_district d on  d.district_id=p.district_id where user_id='".$_SESSION['uid']."'";
$row=$con->query($selQry);
$data=$row->fetch_assoc()
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Profile</title>

<!-- Embedded CSS -->
<style>
     body {
        background-color: #f7f7f7;
        font-family: 'Arial', sans-serif;
        /* margin: 0;
        padding: 0;
        display: flex;  */
        justify-content: center;
        align-items: center;
        /* height: 100vh; */
    } 

    .profile-container {
        background-color: #333;
        width: 350px;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .profile-container img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 4px solid #ffd700;
        margin-bottom: 20px;
        object-fit: cover;
    }

    .profile-container h2 {
        color: #ffd700;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .profile-container table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
        margin: 0 auto;
    }

    .profile-container table td {
        padding: 10px;
        font-size: 16px;
        border-bottom: 1px solid #eee;
        color: #f8f8ff;
    }

    .profile-container table td:first-child {
        font-weight: bold;
        text-align: center;
        color: #ffd700;
    }

    .profile-container .btn-container {
        margin-top: 20px;
    }

    .profile-container .btn-container a {
        display: inline-block;
        background-color: #b8860b;
        color: white;
        padding: 10px 20px;
        margin: 5px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .profile-container .btn-container a:hover {
        background-color: #ffd700;
    }

    .home-link {
        margin-bottom: 15px;
    }

    .home-link a {
        color: #ffd700;
        /* background-color: #ff6b6b; */
        /* padding: 10px 20px;
        border-radius: 5px; */
        text-decoration: none;
        font-size: 16px;
    }

    .home-link a:hover {
        background-color: #ff4b4b;
    }
    .main{
      display:flex;
      justify-content: center;
      align-items: center;
    }
</style>

</head>

<body>

<div class="main"><div class="profile-container">
    <div class="home-link">
        <div align="center"><a href="HomePage.php">Home</a>
        </div>
    </div>

    <div align="center"><img src="../Assets/Files/User/Photo/<?php echo $data['user_photo'] ?>" alt="User Photo" />
      
    </div>
    <h2 align="center"><?php echo $data['user_name'] ?></h2>

    <div align="center">
      <table>
        <tr>
          <td>Gender</td>
          <td><?php echo $data['user_gender'] ?></td>
          </tr>
        <tr>
          <td>Address</td>
          <td><?php echo $data['user_address'] ?></td>
          </tr>
        <tr>
          <td>Contact</td>
          <td><?php echo $data['user_contact'] ?></td>
          </tr>
        <tr>
          <td>Email</td>
          <td><?php echo $data['user_email'] ?></td>
          </tr>
        <tr>
          <td>District</td>
          <td><?php echo $data['district_name'] ?></td>
          </tr>
        <tr>
          <td>Place</td>
          <td><?php echo $data['place_name'] ?></td>
          </tr>
        </table>
      
    </div>
    <div class="btn-container">
      <div align="center"><a href="EditProfile.php">Edit Profile</a>
        <a href="ChangePassword.php">Change Password</a>
      </div>
    </div>
</div></div>

</body>
</html>
<?
include('Foot.php');
?>



