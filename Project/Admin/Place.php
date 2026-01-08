<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$place=$_POST["txt_place"];
	$id=$_POST['txtid'];
	$pincode=$_POST['txt_pincode'];
	$district=$_POST["sel_district"];
	if($id=='')
	{
	$insqry="insert into tbl_place(place_name,place_pincode,district_id)values('".$_POST["txt_place"]."','".$_POST["txt_pincode"]."','".$_POST["sel_district"]."')";
	if($con->query($insqry))
	{
		?>
		<script>
		alert('Inserted');
		window.location="Place.php";
        </script>
        <?php
	}
	}
	else
	{
		$upqry="update tbl_place set place_name='".$place."',place_pincode='".$pincode."',district_id='".$district."' where place_id='".$id."'";
		if($con->query($upqry))
		{
			?>
            <script>
			alert('Updated');
			window.location="Place.php";
			</script>
            <?php
		}
	}
}

if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_place where place_id='".$_GET["delID"]."'";
	if($con->query($delQry))
	{
		?>
		<script>
		alert('Deleted');
		window.location="Place.php";
        </script>
        <?php
	}
}
$did=$dis=$dir="";
if(isset($_GET['eid']))
{
	$selQry="Select * from tbl_place where place_id='".$_GET['eid']."'";
	$datadis=$con->query($selQry);
	$rowdis=$datadis->fetch_assoc();
	$dis=$rowdis['place_name'];
	$did=$rowdis['place_id'];
	$dir=$rowdis['place_pincode'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place</title>
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
        <h1>Place Management</h1>
        <a href="HomePage.php">Home</a>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <th>District</th>
                    <td>
                        <select name="sel_district" id="sel_district">
                            <option>--Select--</option>
                            <?php
                            $sel="select * from tbl_district";
                            $row=$con->query($sel);
                            while($data=$row->fetch_assoc())
                            {
                            ?>
                            <option value="<?php echo $data['district_id']?>"><?php echo $data['district_name']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Place Name</th>
                    <td>
                        <input type="text" name="txt_place" id="txt_place" value="<?php echo $dis ?>" />
                        <input type="hidden" name="txtid" value="<?php echo $did ?>">
                    </td>
                </tr>
                <tr>
                    <th>Pincode</th>
                    <td>
                        <input type="text" name="txt_pincode" id="txt_pincode" value="<?php echo $dir ?>" />
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
                    <th>Place</th>
                    <th>Pincode</th>
                    <th>Action</th>
                </tr>
                <?php
                $i=0;
                $sel="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
                $row=$con->query($sel);
                while($data=$row->fetch_assoc())
                {
                    $i++
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $data['district_name']?></td>
                    <td><?php echo $data['place_name']?></td>
                    <td><?php echo $data['place_pincode']?></td>
                    <td class="action-links">
                        <a href="Place.php?delID=<?php echo $data['place_id']?>">Delete</a>
                        <a href="Place.php?eid=<?php echo $data['place_id']?>">Edit</a>
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
