<?php
ob_start();

include '../../header.php';
include '../../menu.php';
include '../../assets/phpmail/mail.php';

extract($_GET);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"> Reason to Reject Payment </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>members/members.php" class="btn btn-sm btn-outline-secondary">View All Members</a>

            </div>

        </div>
    </div>
    <?php
    extract($_POST);
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'Reason') {

        echo $reason;

        $messages = array();

        if (empty($reason)) {
            $messages['error_username'] = "The email should not be blank!";
        }

        if (($reason == null)) {
            $messages['error_username'] = "The email should not be blank!";
        }

        if (strlen($reason) > 10) {
            $sqlreason = "UPDATE tbl_payment SET reject_reason='$reason' where payment_id='$paymentId' and member_id='$MemberId' and month_id='$Month' and payment_year='$Year' ";
            $db = dbConn();
            $results = $db->query($sqlreason);

           echo  $sqlemail = "SELECT * FROM tbl_members WHERE MemberId='$MemberId'";
            $db = dbConn();
            $results = $db->query($sqlemail);

            $rowemail = $results->fetch_assoc();
            
            $mEmail = $rowemail['Email'];
            $First_Name = $rowemail['First_Name'];
            $Last_Name = $rowemail['Last_Name'];

            $to = $mEmail;
            $toname = $First_Name . '' . $Last_Name;
            $subject = "Notice of Rejection";
            $body = "<h1>Your payment has been rejected</h1>"
                    . "<p>Reaso for rejection is " . $reason . " </p>";
            $alt = "Member Payment CAncellation";
            send_email($to, $toname, $subject, $body, $alt);
        }
    }
    ?>



    <form action="reasons.php"  method="POST">
        <div class="container">


            <div> Customer Name: <?= $MemberId ?> </div>
            <div> Month: <?= $Month ?></div>
            <div> Year: <?= $Year ?> </div>
            <div> paymentId: <?= $paymentId ?> </div>
            <div> Reason:<input type="text" name="reason" value=" <?= @$reason ?>" > </div>

            <input type="hidden" name="MemberId" value=" <?= $MemberId ?>" > 
            <input type="hidden" name="Month" value=" <?= $Month ?>" > 
            <input type="hidden" name="Year" value=" <?= $Year ?>" > 
            <input type="hidden" name="paymentId" value=" <?= $paymentId ?>" > 

            <button type="submit" name="action" value="Reason"> Submit </button>

        </div>  
    </form>




    <?php
    include '../../footer.php';
    ob_end_flush();
    ?>