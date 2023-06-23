<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Payment</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>admin/payments/payments.php" class="btn btn-sm btn-outline-secondary">View Payments</a>

            </div>

        </div>
    </div>
    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $memberid = cleanInput($memberid);
        $sDesc = cleanInput($sDesc);

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($sName)) {
            $messages['error_sName'] = "The Name should not be empty..!";
        }

        if (empty($sDesc)) {
            $messages['error_sDesc'] = "The Description  should not be empty..!";
        }
      
   




        if (empty($messages)) {

            $sql = "INSERT INTO tbl_service(Name,Description,Image) VALUES ('$sName','$sDesc','$file_name_new')";
            $db = dbConn();
            $db->query($sql);

            $sName = null;
            $sDesc = null;
//            $image =  null;
        }
    }
    ?>

    <!-- <?php echo $_SESSION['project_title']; ?> -->

    <form id="formcustomer" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">


        <div class="mb-4 pb-2">

            <label class="form-label" for="form3Examplev5">Select Member</label>

            <?php
            $sql = "SELECT * FROM tbl_members";
            $db = dbConn();
            $result = $db->query($sql);
            ?>
            <select class="form-control" id="title" name="memberid" onchange="loadmember()">
                 <option>-- </option>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
               
                        <option value="<?= $row['MemberId'] ?>" <?php
                        if (@$mPackage == $row['MemberId']) {
                            echo "selected";
                        }
                        ?> ><?= $row['First_Name'] ." " . $row['Last_Name']. " ". $row['Nic'] ?></option>

                        <?php
                    }
                }
                ?>


            </select>
            <div class="text-danger"> <?= @$messages['error_mPackage']; ?></div>
        </div>
        <div id="member_payments">
            
            
        </div>

        



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../../footer.php'; ?>    



<script>
    function loadmember() {
        var formData = $('#formcustomer').serialize();
        $.ajax({
            type: 'POST',
            url: 'memdetails.php',
            data: formData,
            success: function (response) {
               $('#member_payments').html(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
</script>
