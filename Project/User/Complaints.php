<?php
include("../Assets/Connection/Connection.php");
include('Head.php');

if(isset($_POST["btn_submit"]))
{
	$Title=$_POST["txt_title"];
	$Content=$_POST["txt_content"];
	
	 $insqry="insert into tbl_complaint(complaint_title,complaint_content,user_id,complaint_date,product_id)values('".$Title."','".$Content."','".$_SESSION['uid']."',curdate(), '".$_GET["cid"]."')";
	if($con->query($insqry))
	{
		?>
		<script>
		alert('Complained');
		window.location="MyComplaints.php";
        </script>
        <?php
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaints</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #333;
        color: white;
        text-align: center;
        font-weight: normal;
    }

    td input[type="text"], 
    td textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    td input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    td input[type="submit"]:hover {
        background-color: #45a049;
    }

    .center {
        text-align: center;
    }
</style>
</head>

<body>
<div class="container">
    <h1>Submit a Complaint</h1>
    <form id="form1" name="form1" method="post" action="">
        <table>
            <tr>
                <th>Title</th>
                <td><input type="text" name="txt_title" id="txt_title"></td>
            </tr>
            <tr>
                <th>Content</th>
                <td><textarea name="txt_content" id="txt_content" cols="45" rows="5"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" class="center">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Submit">
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
