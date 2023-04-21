<?php
ob_start();
session_start();
include 'config.php';
include 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' type="text/css"/>-->
        <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
        <link rel="stylesheet" href="<?= SYSTEM_PATH ?>assets/css/login.css">
        <link href="<?= SYSTEM_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <title>Gym</title>

    </head>
    <body class="text-center">
        <div class="box">
            <div class="container">

                <div class="top-header">
                    <span>Hey Welcome to Life Fitness Gym !</span>
                    <header>Sign-In</header>
                </div>
                <main class="form-signin w-100 m-auto">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    extract($_POST);
                    $UserName = cleanInput($UserName);

                    $messages = array();

                    if (empty($UserName)) {
                        $messages['error_username'] = "The username should not be blank!";
                    }
                    if (empty($Password)) {
                        $messages['error_password'] = "The password should not be blank!";
                    }

                    if (empty($messages)) {
                        $db = dbConn();
                        $Password = sha1($Password);
                        $sql = "SELECT * FROM tbl_users WHERE UserName='$UserName' AND Password='$Password' AND Status='1' ";
                        $result = $db->query($sql);
                        $result->num_rows;
                        if ($result->num_rows <= 0) {
                            $messages['error_invalid'] = "The User Name or Password is invalid!";
                        } else {
                            //print_r("Hello");
                            $row = $result->fetch_assoc();
                            $_SESSION['UserId'] = $row['UserId'];
                            $_SESSION['Title'] = $row['Title'];
                            $_SESSION['FirstName'] = $row['FirstName'];
                            $_SESSION['LastName'] = $row['LastName'];
                            $_SESSION['UserRole'] = $row['UserRole'];

                            header("Location:index.php");
                        }
                    }
                }
                ?>
               
                <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<!--                <img class="mb-4" src="images/logo.png" alt="" width="72" height="57">-->


                    <div class="text-danger">  
                        <?php echo @$messages['error_username']; ?>
                    </div>
                    <div class="text-danger"> 
                        <?php echo @$messages['error_password']; ?>
                    </div>
                    <div class="text-danger">  
                        <?php echo @$messages['error_invalid']; ?>
                    </div>

                    <div class="input-field">
                        <input type="text" class="input" placeholder="Enter your Username" id="UserName" name="UserName">
            <!--            <i class='bx bx-user' ></i>-->
                    </div>

                    <div class="input-field">
                        <input type="Password" class="input" placeholder="Enter your Password" id="Password" name="Password">
            <!--            <i class='bx bx-lock-alt'></i>-->
                    </div>

<!--                    <div class="input-field">-->
                        <input type="submit" value="Login" id="">
<!--                    </div>-->

                    <div class="bottom">
                        <div class="left">
                            <input type="checkbox" name="" id="check">
                            <label for="check"> Remember Me</label>
                        </div>
                        <div class="right">
                            <label><a href="#">Forgot password?</a></label>
                        </div>
                    </div>
                </form>
                </main>
            </div>
        </div>  
    </body>
</html>

<?php        ob_end_flush(); ?>