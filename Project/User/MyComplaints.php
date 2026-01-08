<?php
include("../Assets/Connection/Connection.php");
include('Head.php');

if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_complaint where complaint_id='".$_GET["delID"]."'";
	if($con->query($delQry))
	{
		?>
		<script>
		alert('Deleted');
		//window.location="MyComplaints.php";
        </script>
        <?php
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Complaints</title>
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

    .btn1 {
        background-color: #ffd700;
        color: black;
        padding: 10px 20px;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        display: inline-block;
    }

    .btn1:hover {
        background-color: #daa520;
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
<div class="container">
    <h1>My Complaints</h1>
    <form id="form1" name="form1" method="post" action="">
        <table width="200" border="1">
            <tr>
                <th scope="row" style="background-color: #333; color: white;"><div align="center">#</div></th>
                <td style="background-color: #333; color: white;"><div align="center">Title</div></td>
                <td style="background-color: #333; color: white;"><div align="center">Content</div></td>
                <td style="background-color: #333; color: white;"><div align="center">Reply</div></td>
                <td style="background-color: #333; color: white;"><div align="center">Date</div></td>
                <td style="background-color: #333; color: white;"><div align="center">Action</div></td>
            </tr>
            <?php
            $i=0;
            $sel="select * from tbl_complaint";
            $row=$con->query($sel);
            while($data=$row->fetch_assoc())
            {
                $i++;
            ?>
            <tr>
                <th scope="row"><?php echo $i ?></th>
                <td><?php echo $data['complaint_title']?></td>
                <td><?php echo $data['complaint_content']?></td>
                <td><?php echo $data['complaint_reply']?></td>
                <td><?php echo $data['complaint_date']?></td>
                <td><a href="MyComplaints.php?delID=<?php echo $data['complaint_id']?>">Delete</a></td>
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
