<?php ob_start(); ?>
<?php $login = "active" ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>


<main id="main">
    <section id="login" class="login">
        <div class="container" data-aos="fade-up">
            <?php if((isset($_GET['success'])) && $_GET['success'] == true){?>
            <div class="alert alert-success" role="alert">
                Registration Successful, Please Login
            </div>
            <?php }; ?>
            <div class="section-header">
                <h2>Please Login to Continue...</h2>
                <p>If you want something you’ve never had, you must be willing to do something you’ve never done.</p>
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

                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    extract($_POST);
                    $Email = cleanInput($Email);

                    $messages = array();

                    if (empty($Email)) {
                        $messages['error_username'] = "The email should not be blank!";
                    }
                    if (empty($Password)) {
                        $messages['error_password'] = "The password should not be blank!";
                    }

                    if (empty($messages)) {
                        $db = dbConn();
                        $Password = sha1($Password);

                        //$sql = "SELECT * FROM tbl_members WHERE Email='$Email' AND Password='$Password' ";
                        $sql = "SELECT * FROM tbl_members WHERE Email='$Email' AND Password='$Password' ";
                        $result = $db->query($sql);
                        $result->num_rows;
                        if ($result->num_rows <= 0) {
                            $messages['error_invalid'] = "The Email or Password is invalid!";
                        } else {
                            print_r("Hello");
                            $row = $result->fetch_assoc();
                            $_SESSION['MemberId'] = $row['MemberId'];
                            $_SESSION['Title'] = $row['Title'];

                            $_SESSION['First_Name'] = $row['First_Name'];
                            $_SESSION['Last_Name'] = $row['Last_Name'];
                            $_SESSION['Email'] = $row['Email'];
                            $_SESSION['Nic'] = $row['Nic'];
                            $_SESSION['Contact'] = $row['Contact'];
                            $_SESSION['Emergency_Contact'] = $row['Emergency_Contact'];
                            $_SESSION['Address'] = $row['Address'];
                            $_SESSION['Age'] = $row['Age'];
                            $_SESSION['Weight'] = $row['Weight'];
                            $_SESSION['Height'] = $row['Height'];
                            $_SESSION['Status'] = $row['Status'];
                            $_SESSION['Approval_Status'] = $row['Approval_Status'];

                            header("Location:members/profile.php");
                        }
                    }
                }
                ?>


                <div class="row"> 
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form  method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="imgcontainer">
                                <img src="assets/img/log.jpg" alt="Avatar" class="avatar" width="20rem">
                            </div>



                            <div class="text-danger">  
                                <?php echo @$messages['error_invalid']; ?>
                            </div>

                            <div class="container col-md-10">
                                <label for="uname"><b>Email</b></label>
                                <div class="text-danger">  
                                    <?php echo @$messages['error_username']; ?>
                                </div>
                                <input class="login" type="text" placeholder="Enter Email" id="UserName" name="Email">

                                <label for="psw"><b>Password</b></label>
                                <div class="text-danger"> 
                                    <?php echo @$messages['error_password']; ?>
                                </div>
                                <input  class="login" type="password" placeholder="Enter Password" id="Password" name="Password" >



                                <button type="submit" class="loginbtn">Login</button>
                                <label>
                                    <input type="checkbox" checked="checked" name="remember"> Remember me
                                </label>
                            </div>

                            <div class="container" style="background-color:#f1f1f1">
                                <a class="signupbtn" href="register.php">SignUp</a>
                                <!--                                <button type="button" class="signupbtn">SignUp</button>-->
                                <span class="psw">Forgot <a href="#">password?</a></span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                </main>
                <?php include 'footer.php'; ?>
                <?php ob_end_flush(); ?>