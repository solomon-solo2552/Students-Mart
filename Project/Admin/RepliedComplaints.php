<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Replied Complaints</title>
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
    </style>
</head>

<body>
<div class="container">
    <h1>Replied Complaints</h1>
    <form id="form1" name="form1" method="post" action="">
        <table>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Title</th>
                <th>Content</th>
                <th>Date</th>
                <th>Reply</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_complaint c INNER JOIN tbl_newuser u ON c.user_id = u.user_id";
            $row = $con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $data['user_name'] ?></td>
                    <td><?php echo $data['complaint_title'] ?></td>
                    <td><?php echo $data['complaint_content'] ?></td>
                    <td><?php echo $data['complaint_date'] ?></td>
                    <td><?php echo $data['complaint_reply'] ?></td>
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
