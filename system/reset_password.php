
<?php

ob_start();
session_start();
include 'function.php';
include 'assets/phpmail/mail.php';
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $resetmemberid = $_SESSION['resetmemberidz'];

    $resetmemberfirstname = $_SESSION['resetFirst_Name'];
    $resetmemberlastname = $_SESSION['resetLast_Name'];
    $resetmemberemail = $_SESSION['resetEmail'];

    extract($_POST);

    $Token = cleanInput($Token);
    $Npassword = cleanInput($Npassword);
    $Cpassword = cleanInput($Cpassword);

    $messages = array();

    if (empty($Token)) {
        $messages['error_token'] = "The token should not be blank!";
    }

    if (empty($Npassword)) {
        $messages['error_password'] = "The New Password should not be blank!";
    }

    if (empty($Cpassword)) {
        $messages['error_confirm'] = "The Confirm Password should not be blank!";
    }

    if (!empty($Npassword)) {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $Npassword);
        $lowercase = preg_match('@[a-z]@', $Npassword);
        $number = preg_match('@[0-9]@', $Npassword);
        $specialChars = preg_match('@[^\w]@', $Npassword);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($Npassword) < 8) {
            $messages['error_newpassword'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!";
        }
    }



    if ((!empty($Npassword)) && (!empty($Cpassword))) {

        if ($Npassword != $Cpassword) {
            $messages['error_password'] = " Passwords are not match";
        }
    }


    if (!empty($Token)) {

//        print_r($resetcustomerid);
        echo $sql = "SELECT * FROM tbl_users WHERE passwordreset='$Token' AND UserId=$resetmemberid";
        $db = dbConn();
        $results = $db->query($sql);
        if ($results->num_rows > 0) {
            echo 'token is valid';
        } else {
            $messages['error_token'] = "This Entered token is invalid";
        }
    }

    if (empty($messages)) {
        $db = dbConn();
        $Npasswordz = sha1($Npassword);
        echo $sql = "UPDATE tbl_users SET Password = '$Npasswordz' WHERE UserId= '$resetmemberid' ";
        $results = $db->query($sql);

        $to = $resetmemberemail;
        $toname = $resetmemberfirstname . $resetmemberlastname;
        $subject = "Welcome back to Life Fitness Gym ";
        $body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
  <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
  <title></title>
  
    <style type="text/css">
      @media only screen and (min-width: 620px) {
  .u-row {
    width: 600px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-100 {
    width: 600px !important;
  }

}

@media (max-width: 620px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: 100% !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors="true"] {
  color: inherit !important;
  text-decoration: none !important;
}

table, td { color: #000000; } #u_body a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_1 .v-container-padding-padding { padding: 40px 10px 10px !important; } #u_content_image_1 .v-src-width { width: auto !important; } #u_content_image_1 .v-src-max-width { max-width: 50% !important; } #u_content_heading_1 .v-container-padding-padding { padding: 10px 10px 20px !important; } #u_content_heading_1 .v-font-size { font-size: 22px !important; } #u_content_heading_2 .v-container-padding-padding { padding: 40px 10px 10px !important; } #u_content_text_2 .v-container-padding-padding { padding: 10px !important; } #u_content_heading_3 .v-container-padding-padding { padding: 10px !important; } #u_content_button_1 .v-container-padding-padding { padding: 30px 10px 40px !important; } #u_content_button_1 .v-size-width { width: 65% !important; } }
    </style>
  
  

<!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->

</head>

<body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #f9f9ff;color: #000000">
  <!--[if IE]><div class="ie-container"><![endif]-->
  <!--[if mso]><div class="mso-container"><![endif]-->
  <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #f9f9ff;width:100%" cellpadding="0" cellspacing="0">
  <tbody>
  <tr style="vertical-align: top">
    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #f9f9ff;"><![endif]-->
    

<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
      <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
      
<!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #ffffff;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
  <div style="background-color: #ffffff;height: 100%;width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
<table id="u_content_image_1" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:60px 10px 10px;font-family:"Raleway",sans-serif;" align="left">
        
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td style="padding-right: 0px;padding-left: 0px;" align="center">
      
      <img align="center" border="0" src="" alt="image" title="image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 35%;max-width: 203px;" width="203" class="v-src-width v-src-max-width"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>

<table id="u_content_heading_1" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 30px;font-family:"Raleway",sans-serif;" align="left">
        
  <h1 class="v-font-size" style="margin: 0px; line-height: 140%; text-align: center; word-wrap: break-word; font-size: 28px; font-weight: 400;"><strong>Your Password has been reset successfully !</strong></h1>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
      <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
      
<!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #ffffff;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
<div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
  <div style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
  <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
  
<table id="u_content_heading_2" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:40px 60px 10px;font-family:"Raleway",sans-serif;" align="left">
        
  <h1 class="v-font-size" style="margin: 0px; line-height: 140%; text-align: left; word-wrap: break-word; font-size: 16px; font-weight: 400;">Yayy, We are so happy that you got us, Welcome Back!</h1>
  <p> Life Fitness Gym .. </p>

      </td>
    </tr>
  </tbody>
</table>

<table id="u_content_text_2" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 60px;font-family:"Raleway",sans-serif;" align="left">
        
  <div class="v-font-size" style="font-size: 14px; color: #1386e5; line-height: 140%; text-align: left; word-wrap: break-word;">
    <p style="line-height: 140%;"><span style="text-decoration: underline; line-height: 19.6px;"><span style="line-height: 19.6px;"><strong></strong></span></span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table id="u_content_heading_3" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 60px;font-family:"Raleway",sans-serif;" align="left">
        
  <h1 class="v-font-size" style="margin: 0px; line-height: 140%; text-align: left; word-wrap: break-word; font-size: 14px; font-weight: 400;"></h1>

      </td>
    </tr>
  </tbody>
</table>

<table id="u_content_button_1" style="font-family:"Raleway",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 40px;font-family:"Raleway",sans-serif;" align="left">
        
  <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->


      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>


    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    </td>
  </tr>
  </tbody>
  </table>
  <!--[if mso]></div><![endif]-->
  <!--[if IE]></div><![endif]-->
</body>

</html>
';
        $altbody = "Customer Password Reset";
        send_email($to, $toname, $subject, $body, $altbody);
        header("Location:login.php");
    }
}
?>

<main id="main">
    <section id="login" class="login">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Reset Your Password </h2>
                <p>Please check your email, copy and paste the code in the below form</p>
            </div>


            <!-- Section: Design Block -->
            <section class=" text-center text-lg-start">
                <style>
                    body {
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    form {
                        border: 3px solid #f1f1f1;

                    }

                    input[type=text], input[type=password] {
                        width: 100%;
                        padding: 12px 20px;
                        margin: 8px 0;
                        display: inline-block;
                        border: 1px solid #ccc;
                        box-sizing: border-box;
                    }

                    button {
                        background-color: #04AA6D;
                        color: white;
                        padding: 14px 20px;
                        margin: 8px 0;
                        border: none;
                        cursor: pointer;
                        width: 100%;
                    }

                    button:hover {
                        opacity: 0.8;
                    }

                    .signupbtn {
                        width: auto;
                        padding: 10px 18px;
                        background-color: #0189a1;
                    }

                    .imgcontainer {
                        text-align: center;
                        margin: 24px 0 12px 0;
                    }

                    img.avatar {
                        width: 15%;
                        border-radius: 50%;
                        height: 0%;
                    }

                    .container {
                        padding: 16px;
                    }

                    span.psw {
                        float: right;
                        padding-top: 16px;
                    }

                    /* Change styles for span and cancel button on extra small screens */
                    @media screen and (max-width: 300px) {
                        span.psw {
                            display: block;
                            float: none;
                        }
                        .cancelbtn {
                            width: 100%;
                        }
                    }
                </style>
                <div class="row"> 
                    <div class="col-md-2"></div>
                    <div class="col-md-8">


                        <form  method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="imgcontainer">
<!--                                <img src="assets/img/log.jpg" alt="Avatar" class="avatar" width="20rem">-->
                            </div>
                            <div class="text-danger">  

                                <?php echo @$messages['error_newpassword']; ?>
                                <?php echo @$messages['error_invalid']; ?>
                            </div>  

                            <div class="container col-md-10">
                                <label for="uname"><b>Enter the copied code from your email</b></label>
                                <div class="text-danger">  
                                    <?php echo @$messages['error_token']; ?>
                                </div>
                                <input class="login" type="text" placeholder="Enter Code" id="UserName" name="Token" value="<?= @$Token ?>">

                                <label for="uname"><b>New Password</b></label>
                                <div class="text-danger">  
                                    <?php echo @$messages['error_password']; ?>
                                </div>
                                <input class="login" type="password" placeholder="Enter New Password" id="nPassword" name="Npassword" value="<?= @$Npassword ?>">
                                <span class="toggle-password bi bi-eye" onclick="togglenPasswordVisibility()"></span>
                                <script>
                                    function togglenPasswordVisibility() {
                                        var passwordInput = document.getElementById("nPassword");
                                        var eyeIcon = document.querySelector(".toggle-password");
                                        if (passwordInput.type === "password") {
                                            passwordInput.type = "text";
                                            eyeIcon.classList.remove("bi-eye");
                                            eyeIcon.classList.add("bi-eye-slash");
                                        } else {
                                            passwordInput.type = "password";
                                            eyeIcon.classList.remove("bi-eye-slash");
                                            eyeIcon.classList.add("bi-eye");
                                        }
                                    }
                                </script>

                                <label for="uname"><b>Confirm New Password</b></label>
                                <div class="text-danger">  
                                    <?php echo @$messages['error_confirm']; ?>
                                </div>
                                <input class="login" type="password" placeholder="Enter Confirm Password" id="cPassword" name="Cpassword" value="<?= @$Cpassword ?>">
                                <span class="toggle-password bi bi-eye" onclick="togglecPasswordVisibility()"></span>
                                <script>
                                    function togglecPasswordVisibility() {
                                        var passwordInput = document.getElementById("cPassword");
                                        var eyeIcon = document.querySelector(".toggle-password");
                                        if (passwordInput.type === "password") {
                                            passwordInput.type = "text";
                                            eyeIcon.classList.remove("bi-eye");
                                            eyeIcon.classList.add("bi-eye-slash");
                                        } else {
                                            passwordInput.type = "password";
                                            eyeIcon.classList.remove("bi-eye-slash");
                                            eyeIcon.classList.add("bi-eye");
                                        }
                                    }
                                </script>

                                <button type="submit" class="loginbtn">Reset</button>

                            </div>


                        </form>
                    </div>

                </div>

                </main>




                <?php
//                print_r($_SESSION);
                ob_end_flush();
                ?>