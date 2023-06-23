<?php $product = 'active'; ?>

<?php include 'header.php'; ?>
<?php include 'menu.php'; ?> 

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    

   

    <?php echo @$_SESSION['project_title']; ?>

    <form id="formcustomer" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <!--        <div class="mb-3">
                    <label for="product_name" class="form-label">Enter Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="pName" value="<?= @$pName; ?>">
                    
                </div>-->
        <div class="row">
            
             <!--      category start-->
            <div class="col-md-4">
                <div class="mb-3">
<?php
$sql = "SELECT * FROM tbl_members ";
$db = dbConn();
$result = $db->query($sql);
?>
                    <label>Select Category</label>
                    <select id="category" name="pCategory" class="form-control"  onchange="loadCustomerName()">
                        <option value="">--</option>
                    <?php
                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                            ?>

                                <option value="<?= $row['MemberId'] ?>" <?php
                                if (@$pCategory == $row['MemberId']) {
                                    echo "selected";
                                }
                                ?> ><?= $row['First_Name'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <div class="text-danger"> <?= @$messages['error_category']; ?></div>
                </div>
            </div>
            <!--      category end-->
            
            
            <div id="productlist">
                
            </div>
            
        
  
        </div>

      

</main>
<?php include 'footer.php'; ?>



<script>
    function loadCustomerName() {
        var formData = $('#formcustomer').serialize();
        $.ajax({
            type: 'POST',
            url: 'testing.php',
            data: formData,
            success: function (response) {
               $('#productlist').html(response);
                //$('#citylist').modal('show');
                //alert(response)
            },
            error: function () {
                alert('Error submitting the form!');
            }
        });
    }
</script>