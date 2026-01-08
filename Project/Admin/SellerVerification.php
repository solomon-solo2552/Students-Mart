<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if (isset($_GET["acID"])) {
    $upQry = "update tbl_seller set seller_status='1' where seller_id='" . $_GET["acID"] . "'";
    if ($con->query($upQry)) {
        ?>
        <script>
            alert('Accepted');
            window.location = "SellerVerification.php";
        </script>
        <?php
    }
}

if (isset($_GET["rejID"])) {
    $upQry = "update tbl_seller set seller_status='2' where seller_id='" . $_GET["rejID"] . "'";
    if ($con->query($upQry)) {
        ?>
        <script>
            alert('Rejected');
            window.location = "SellerVerification.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Seller Verification</title>
    <style>
    .containers {
        max-width: 700px;
        margin: 20px auto;
        padding: 20px;
        background-color: #1e1e1e;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    h1, h3 {
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
        width: 100%; /* Use full width of the container */
        border-collapse: collapse;
        margin-bottom: 20px;
        table-layout: auto; /* Allows columns to adjust based on content */
    }

    table, th, td {
        border: 1px solid #424242;
    }

    th, td {
        padding: 8px; /* Reduced padding for better fit */
        text-align: center;
        word-wrap: break-word; /* Allows long text to break into the next line */
        max-width: 150px; /* Set a max width for each cell to prevent overflow */
    }

    th {
        background-color: #2c2c2c;
    }

    td {
        background-color: #1f1f1f;
    }

    td img {
        max-width: 75px; /* Ensure images do not exceed their allocated space */
        height: auto; /* Maintain aspect ratio */
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
<div class="containers">
    <h1>Seller Verification</h1>
    <a href="HomePage.php">Home</a>

    <h3>New Seller</h3>
    <table width="244" border="1">
        <tr>
            <td width="58"><div align="center">#</div></td>
            <td width="80"><div align="center">District</div></td>
            <td width="80"><div align="center">Place</div></td>
            <!-- <td width="80"><div align="center">Pincode</div></td> -->
            <td>Name</td>
            <td>Email</td>
            <td>Address</td>
            <td>Contact</td>
            <td>Photo</td>
            <td>Proof</td>
            <td width="84"><div align="center">Action</div></td>
        </tr>
        <?php
        $i = 0;
        $sel = "select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where s.seller_status='0'";
        $row = $con->query($sel);
        while ($data = $row->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $data['district_name'] ?></td>
                <td><?php echo $data['place_name'] ?></td>
                <!-- <td><?php echo $data['place_pincode'] ?></td> -->
                <td><?php echo $data['seller_name'] ?></td>
                <td><?php echo $data['seller_email'] ?></td>
                <td><?php echo $data['seller_address'] ?></td>
                <td><?php echo $data['seller_contact'] ?></td>
                <td><img src="../Assets/Files/Seller/Photo/<?php echo $data['seller_photo'] ?>" width="75" height="75" /></td>
                <td><img src="../Assets/Files/Seller/Proof/<?php echo $data['seller_proof'] ?>" width="75" height="75" /></td>
                <td>
                    <a href="SellerVerification.php?acID=<?php echo $data['seller_id'] ?>">Accept</a>
                    <a href="SellerVerification.php?rejID=<?php echo $data['seller_id'] ?>">Reject</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <h3>Accepted List</h3>
    <table width="244" border="1">
        <tr>
            <td width="58"><div align="center">#</div></td>
            <td width="80"><div align="center">District</div></td>
            <td width="80"><div align="center">Place</div></td>
            <!-- <td width="80"><div align="center">Pincode</div></td> -->
            <td>Name</td>
            <td>Email</td>
            <td>Address</td>
            <td>Contact</td>
            <td>Photo</td>
            <td>Proof</td>
            <td width="84"><div align="center">Action</div></td>
        </tr>
        <?php
        $i = 0;
        $sel = "select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where s.seller_status='1'";
        $row = $con->query($sel);
        while ($data = $row->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $data['district_name'] ?></td>
                <td><?php echo $data['place_name'] ?></td>
                <!-- <td><?php echo $data['place_pincode'] ?></td> -->
                <td><?php echo $data['seller_name'] ?></td>
                <td><?php echo $data['seller_email'] ?></td>
                <td><?php echo $data['seller_address'] ?></td>
                <td><?php echo $data['seller_contact'] ?></td>
                <td><img src="../Assets/Files/Seller/Photo/<?php echo $data['seller_photo'] ?>" width="75" height="75" /></td>
                <td><img src="../Assets/Files/Seller/Proof/<?php echo $data['seller_proof'] ?>" width="75" height="75" /></td>
                <td>
                    <a href="SellerVerification.php?rejID=<?php echo $data['seller_id'] ?>">Reject</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <h3>Rejected List</h3>
    <table width="244" border="1">
        <tr>
            <td width="58"><div align="center">#</div></td>
            <td width="80"><div align="center">District</div></td>
            <td width="80"><div align="center">Place</div></td>
            <!-- <td width="80"><div align="center">Pincode</div></td> -->
            <td>Name</td>
            <td>Email</td>
            <td>Address</td>
            <td>Contact</td>
            <td>Photo</td>
            <td>Proof</td>
            <td width="84"><div align="center">Action</div></td>
        </tr>
        <?php
        $i = 0;
        $sel = "select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where s.seller_status='2'";
        $row = $con->query($sel);
        while ($data = $row->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $data['district_name'] ?></td>
                <td><?php echo $data['place_name'] ?></td>
                <!-- <td><?php echo $data['place_pincode'] ?></td> -->
                <td><?php echo $data['seller_name'] ?></td>
                <td><?php echo $data['seller_email'] ?></td>
                <td><?php echo $data['seller_address'] ?></td>
                <td><?php echo $data['seller_contact'] ?></td>
                <td><img src="../Assets/Files/Seller/Photo/<?php echo $data['seller_photo'] ?>" width="75" height="75" /></td>
                <td><img src="../Assets/Files/Seller/Proof/<?php echo $data['seller_proof'] ?>" width="75" height="75" /></td>
                <td>
                    <a href="SellerVerification.php?acID=<?php echo $data['seller_id'] ?>">Accept</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>
<?php
include("Foot.php");
?>
