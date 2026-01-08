<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$category=$_POST["txt_cat"];
	$id=$_POST['txtid'];
	if($id=='')
	{
	$insqry="insert into tbl_category(category_name)values('".$category."')";
	if($con->query($insqry))
	{
		?>
		<script>
		alert('Inserted');
		window.location="Category.php";
        </script>
        <?php
	}
	}
	else
	{
		$upqry="update tbl_category set category_name='".$category."' where category_id='".$id."'";
		if($con->query($upqry))
		{
			?>
            <script>
			alert('Updated');
			window.location="Category.php";
			</script>
            <?php
		}
	}
}

if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_category where category_id='".$_GET["delID"]."'";
	if($con->query($delQry))
	{
		?>
		<script>
		alert('Deleted');
		window.location="Category.php";
        </script>
        <?php
	}
}
$did=$dis="";
if(isset($_GET['eid']))
{
	$selQry="Select * from tbl_category where category_id='".$_GET['eid']."'";
	$datadis=$con->query($selQry);
	$rowdis=$datadis->fetch_assoc();
	$dis=$rowdis['category_name'];
	$did=$rowdis['category_id'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Category</title>
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
        <h1>Category Management</h1>
        <a href="HomePage.php">Home</a>
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <th>Category</th>
                    <td>
                        <input type="text" name="txt_cat" id="txt_cat" value="<?php echo $dis ?>" />
                        <input type="hidden" name="txtid" value="<?php echo $did ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                <?php
                $i=0;
                $sel="select * from tbl_category";
                $row=$con->query($sel);
                while($data=$row->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['category_name'] ?></td>
                    <td class="action-links">
                        <a href="Category.php?delID=<?php echo $data['category_id']?>">Delete</a>
                        <a href="Category.php?eid=<?php echo $data['category_id']?>">Edit</a>
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
