<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if (isset($_GET["rcID"])) {
    $upQry = "update tbl_complaint set complaint_status='2' where complaint_id='" . $_GET["rcID"] . "'";
    if ($con->query($upQry)) {
        ?>
        <script>
            alert('Replied');
            window.location = "ViewComplaints.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View Complaints</title>
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
    <h1>View Complaints</h1>
    <a href="HomePage.php">Home</a>
    <form id="form1" name="form1" method="post" action="">
        <table>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Title</th>
                <th>Content</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "Select * from tbl_complaint c inner join tbl_newuser u on c.user_id=u.user_id";
            $row = $con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['user_name'] ?></td>
                    <td><?php echo $data['complaint_title'] ?></td>
                    <td><?php echo $data['complaint_content'] ?></td>
                    <td><?php echo $data['complaint_date'] ?></td>
                    <td class="action-links">
                        <a href="Reply.php?repID=<?php echo $data['complaint_id'] ?>">Reply</a>
                        <?php
                        if ($data['complaint_status'] == 2) {
                            ?>
                            <a href="ViewComplaints.php?rcID=<?php echo $data['complaint_id'] ?>">Mark as Replied</a>
                            <?php
                        }
                        ?>
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
