<?php
$result=' ';
if(isset($_POST['btm_submit']))
{
	$num1=$_POST['txt_num1'];
	$num2=$_POST['txt_num2'];
	$num3=$_POST['txt_num3'];
	
	if($num1>$num2)
	{
		if($num1>$num3)
		{
			$result=$num1;
		}
		elseif($num2>$num3)
		{
			$result=$num2;
		}
		else
		{
			$result=$num3;
		}
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
<form action="" method="post">
<table width="315" border="1">
  <tr>
    <td width="163"><div align="center">Number1</div></td>
    <td width="136"><label for="txt_num1"></label>
      <input type="text" name="txt_num1" id="txt_num1" /></td>
  </tr>
  <tr>
    <td><div align="center">Number2</div></td>
    <td><label for="txt_num2"></label>
      <input type="text" name="txt_num2" id="txt_num2" /></td>
  </tr>
  <tr>
    <td><div align="center">Number3</div></td>
    <td><label for="txt_num3"></label>
      <input type="text" name="txt_num3" id="txt_num3" /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btm_submit" id="btm_submit" value="Submit" />
    </div></td>
    </tr>
  <tr>
    <td><div align="center">Result</div></td>
    <td><?php echo $result;?></td>
  </tr>
</table>
</form>
</body>
</html>