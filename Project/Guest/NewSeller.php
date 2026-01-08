<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
{
    $Name=$_POST["txt_name"];
    $Contact=$_POST["txt_contact"];
    $Email=$_POST["txt_email"];
    $Address=$_POST["txt_address"];
    $Password=$_POST["txt_password"];
    
    $Place=$_POST["sel_place"];
    
    $Photo=$_FILES["file_photo"]['name'];
    $Proof=$_FILES["file_proof"]['name'];
    
    $temp=$_FILES['file_photo']['tmp_name'];
    $temp1=$_FILES['file_proof']['tmp_name'];
    
    move_uploaded_file($temp,'../Assets/Files/Seller/Photo/'.$Photo);
    move_uploaded_file($temp1,'../Assets/Files/Seller/Proof/'.$Proof);
    
    $insqry="insert into tbl_seller(seller_name,seller_contact,seller_address,seller_email,seller_password,seller_photo,seller_proof,place_id) values('".$Name."','".$Contact."','".$Address."','".$Email."','".$Password."','".$Photo."','".$Proof."','".$Place."')";
    if($con->query($insqry))
    {
        ?>
        <script>
        alert('inserted');
        window.location="NewSeller.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Seller Registration</title>
    <!-- Include the CSS files from the first program -->
    <link rel="stylesheet" href="../Assets/Template/Admin/template/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../Assets/Template/Admin/template/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../Assets/Template/Admin/template/assets/css/style.css">
    <style>
        .form-container {
            max-width: 400px; /* Smaller width to match second program */
            margin: auto;
            padding: 5px; /* Minimal padding */
        }
        .form-group {
            margin-bottom: 5px; /* Small margin */
            
        }
        .form-control {
            padding: 4px; /* Adjust padding */
            /* background-color: white; */
        }
        textarea {
            height: 40px; /* Reduce height */
        }
        /* Adjust button size */
        .btn {
            padding: 5px; /* Adjust button padding */
            font-size: 12px; /* Adjust font size */
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-6 mx-auto form-container">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">New Seller Registration</h3>
                            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="form-group">
                                    <label for="sel_dist">District</label>
                                    <select name="sel_dist" id="sel_dist" class="form-control" onChange="getPlace(this.value)" required >
                                        <option>--Select--</option>
                                        <?php
                                            $sel="select * from tbl_district";
                                            $row=$con->query($sel);
                                            while($data=$row->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $data['district_id']?>"><?php echo $data['district_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sel_place">Place</label>
                                    <select name="sel_place" id="sel_place" class="form-control" required >
                                        <option>--Select--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txt_name">Name</label>
                                    <input type="text" name="txt_name" id="txt_name" class="form-control" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required />
                                </div>
                                <div class="form-group">
                                    <label for="txt_email">Email</label>
                                    <input type="text" name="txt_email" id="txt_email" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="txt_address">Address</label>
                                    <textarea name="txt_address" id="txt_address" class="form-control" cols="45" rows="2" required ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="txt_contact">Contact</label>
                                    <input type="text" name="txt_contact" id="txt_contact" class="form-control" pattern="[7-9]{1}[0-9]{9}" 
                                    title="Phone number with 7-9 and remaing 9 digit with 0-9" required />
                                </div>
                                <div class="form-group">
                                    <label for="txt_password">Password</label>
                                    <input type="password" name="txt_password" id="txt_password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                                </div>
                                <div class="form-group">
                                    <label for="txt_confirmpassword">Confirm Password</label>
                                    <input type="password" name="txt_confirmpassword" id="txt_confirmpassword" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label for="file_photo">Photo</label>
                                    <input type="file" name="file_photo" id="file_photo" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label for="file_proof">Proof</label>
                                    <input type="file" name="file_proof" id="file_proof" class="form-control" required />
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary btn-block">Submit</button>
                                    <button type="reset" name="btn_cancel" id="btn_cancel" class="btn btn-secondary btn-block">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function getPlace(did) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
                success: function(result) {
                    $("#sel_place").html(result);
                }
            });
        }
    </script>
</body>
</html>
