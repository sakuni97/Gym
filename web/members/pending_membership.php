<?php ob_start(); ?>
<?php $profile = "active" ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<?php include 'sidebar.php'; ?>

<?php
$db = dbConn();
$memberidsession = $_SESSION['MemberId'];
$sql = "SELECT * FROM tbl_members WHERE MemberId= '$memberidsession' AND Approval_Status=0";
$results = $db->query($sql);
$row = $results->fetch_assoc();
?>

<main id="main">
    <section id="about" class="about">
        <div class="container" >


            <div class="section-header">
                <h3>Hey <?= @$_SESSION['First_Name'] ?> !!</h3>
                <p>You are in the correct track, We got you...</p>
                <?php
                if ($results->num_rows == 1) {
                    echo '<span style="color: red;">Your membership is still pending! Wait till your payments get approved to continue...</span>';
                } else {
                    echo 'hello prens';
                }
                ?>
            </div>




        </div>
        <!--Main Navigation-->
    </section>
</main>
<?php ob_end_flush(); ?>