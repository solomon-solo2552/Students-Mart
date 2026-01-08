<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$district=$_POST["txt_dist"];
	$id=$_POST['txtid'];
	if($id=='')
	{
	$insqry="insert into tbl_district(district_name)values('".$district."')";
	if($con->query($insqry))
	{
		?>
		<script>
		alert('Inserted');
		window.location="District.php";
        </script>
        <?php
	}
	}
	else
	{
		$upqry="update tbl_district set district_name='".$district."' where district_id='".$id."'";
		if($con->query($upqry))
		{
			?>
            <script>
			alert('Updated');
			window.location="District.php";
			</script>
            <?php
		}
	}
}


if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_district where district_id='".$_GET["delID"]."'";
	if($con->query($delQry))
	{
		?>
		<script>
		alert('Deleted');
		window.location="District.php";
        </script>
        <?php
	}
}
$did=$dis="";
if(isset($_GET['eid']))
{
	$selQry="Select * from tbl_district where district_id='".$_GET['eid']."'";
	$datadis=$con->query($selQry);
	$rowdis=$datadis->fetch_assoc();
	$dis=$rowdis['district_name'];
	$did=$rowdis['district_id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District</title>
<style>
	body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #121212;
    color: #e0e0e0;
    /* margin: 0; */
    /* padding: 20px; */
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

input[type="text"] {
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
        <h1>District Management</h1>
        <a href="HomePage.php">Home</a>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <th>District Name</th>
                    <td>
                        <input type="text" name="txt_dist" id="txt_dist3" value="<?php echo $dis ?>" />
                        <input type="hidden" name="txtid" value="<?php echo $did ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                        <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>#</th>
                    <th>District</th>
                    <th>Action</th>
                </tr>
                <?php
                $i=0;
                $sel="select * from tbl_district";
                $row=$con->query($sel);
                while($data=$row->fetch_assoc())
                {
                    $i++
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $data['district_name']?></td>
                    <td class="action-links">
                        <a href="District.php?delID=<?php echo $data['district_id']?>">Delete</a>
                        <a href="District.php?eid=<?php echo $data['district_id']?>">Edit</a>
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