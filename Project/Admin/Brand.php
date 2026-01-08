<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
	$brand=$_POST["txt_brd"];
	$id=$_POST["txtid"];
	$insqry="insert into tbl_brand(brand_name)values('".$brand."')";
	if($id=='')
	{
	$insqry="insert into tbl_brand(brand_name)values('".$brand."')";
	if($con->query($insqry))
	{
		?>
		<script>
		alert('inserted');
		window.location="Brand.php";
        </script>
        <?php
	}
	}
	else
	{
		$upqry="update tbl_brand set brand_name='".$brand."' where brand_id='".$id."'";
		if($con->query($upqry))
		{
			?>
            <script>
			alert('Updated');
			window.location="Brand.php";
			</script>
            <?php
		}
	}
}


if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_brand where brand_id='".$_GET["delID"]."'";
	if($con->query($delQry))
	{
		?>
		<script>
		alert('Deleted');
		window.location="Brand.php";
        </script>
        <?php
	}
}

$did=$dis="";
if(isset($_GET['eid']))
{
	$selQry="Select * from tbl_brand where brand_id='".$_GET['eid']."'";
	$datadis=$con->query($selQry);
	$rowdis=$datadis->fetch_assoc();
	$dis=$rowdis['brand_name'];
	$did=$rowdis['brand_id'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<td><a href="HomePage.php">Home</a></td>
<form id="form1" name="form1" method="post" action="">
  <table width="368" border="1">
    <tr>
      <td width="155"><div align="center">Brand Name</div></td>
      <td width="197"><label for="txt_brd"></label>
      <input type="text" name="txt_brd" id="txt_brd" value="<?php echo $dis ?>" />
        <input type="hidden" name="txtid" value="<?php echo $did ?>"></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
  <table width="371" border="1">
    <tr>
      <td width="80"><div align="center">#</div></td>
      <td width="106"><div align="center">Brand Name</div></td>
      <td width="163"><div align="center">Action</div></td>
    </tr>
    <?php
	$i=0;
	$sel="select * from tbl_brand";
	$row=$con->query($sel);
	while($data=$row->fetch_assoc())
	{
		$i++
		?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['brand_name']?></td>
      <td><a href="Brand.php?delID=<?php echo $data['brand_id']?>">Delete</a>  
          <a href="Brand.php?eid=<?php echo $data['brand_id']?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>
