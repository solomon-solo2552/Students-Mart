<?php
include("../Assets/Connection/Connection.php");
include('Head.php');
if(isset($_POST["btn_submit"]))
{
	$Name=$_POST["txt_name"];
	$Price=$_POST["txt_price"];
	$Photo=$_FILES["file_photo"]['name'];
	$Category=$_POST["sel_category"];
	$Subcategory=$_POST["sel_sub"];
	$temp=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/Seller/Product/'.$Photo);

	$insqry="insert into tbl_product(product_name,product_price,product_photo,subcategory_id,seller_id)values('".$Name."','".$Price."','".$Photo."','".$Subcategory."','".$_SESSION['sid']."')";
	if($con->query($insqry))
	{
		?>
		<script>
		alert('inserted');
		window.location="Product.php";
        </script>
          <?php
		}
	}

if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_product where product_id='".$_GET["delID"]."'";
	if($con->query($delQry))
	{
		?>
		<script>
		alert('Deleted');
		window.location="Product.php";
        </script>
        <?php
	}
}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Management</title>

<!-- Embedded CSS for styling -->
<style>
 

  .container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-top: 30px;
  }

  h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
  }

  form {
    margin-bottom: 30px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  table, th, td {
    border: 1px solid #dddddd;
    padding: 10px;
  }

  th {
    background-color: #708090;
    color: white;
    text-align: center;
  }

  td {
    text-align: center;
    color: #333;
  }

  input[type="text"], select, input[type="file"] {
    width: 100%;
    padding: 8px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type="submit"] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
  }

  input[type="submit"]:hover {
    background-color: #45a049;
  }

  .action-links a {
    text-decoration: none;
    padding: 8px 12px;
    background-color: #ff6b6b;
    color: white;
    border-radius: 5px;
    margin: 5px;
    display: inline-block;
    transition: background-color 0.3s;
  }

  .action-links a:hover {
    background-color: #ff4b4b;
  }

  .image-preview {
    max-width: 75px;
    height: auto;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
</style>

</head>

<body>

<div class="container">
  <h1>Product Management</h1>
  
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <table>
      <tr>
        <td>Name</td>
        <td><input type="text" name="txt_name" id="txt_name" /></td>
      </tr>
      <tr>
        <td>Price</td>
        <td><input type="text" name="txt_price" id="txt_price" /></td>
      </tr>
      <tr>
        <td>Photo</td>
        <td><input type="file" name="file_photo" id="file_photo" /></td>
      </tr>
      <tr>
        <td>Category</td>
        <td>
          <select name="sel_category" id="sel_category" onChange="getSubcategory(this.value)">
            <option>--Select--</option>
            <?php
              $sel = "select * from tbl_category";
              $row = $con->query($sel);
              while($data = $row->fetch_assoc()) {
            ?>
              <option value="<?php echo $data['category_id']?>"><?php echo $data['category_name']?></option>
            <?php
              }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Subcategory</td>
        <td>
          <select name="sel_sub" id="sel_sub">
            <option>--Select--</option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        </td>
      </tr>
    </table>
  </form>

  <h2>Product List</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Price</th>
        <th>Photo</th>
        <th>Category</th>
        <th>Subcategory</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      $sel = "select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id inner join tbl_category c on c.category_id=s.category_id where seller_id=".$_SESSION['sid'];
      $row = $con->query($sel);
      while($data = $row->fetch_assoc()) {
        $i++;
    ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['product_name']?></td>
        <td><?php echo $data['product_price']?></td>
        <td><img src="../Assets/Files/Seller/Product/<?php echo $data['product_photo']?>" class="image-preview" /></td>
        <td><?php echo $data['category_name']?></td>
        <td><?php echo $data['subcategory_name']?></td>
        <td class="action-links">
          <a href="Product.php?delID=<?php echo $data['product_id']?>">Delete</a>
          <a href="Stock.php?asID=<?php echo $data['product_id']?>">Add Stock</a>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>

<!-- Script for subcategory fetching -->
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getSubcategory(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxSubcategory.php?did=" + did,
      success: function (result) {
        $("#sel_sub").html(result);
      }
    });
  }
</script>

</body>
</html>
<?php
include('Foot.php');
?>
