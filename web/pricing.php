<?php $pricing = "active" ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<style>
    .wrapper2 {
        position: relative;
        height: 1px;
        padding: 0px;
    }

    /* Styling for the open form button */
    #open-form-btn {
        position: fixed;
        bottom: 410px;
        right: 20px;
        background-color: #146c43;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 8%;
        z-index: 10;
    }

    #open-form-btn:hover {
        opacity: 0.8;
    }

    /* Styles for popup form */
    .popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .popup-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        margin-top: -10px;
        margin-right: -10px;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<div class="wrapper2">
    <button id="open-form-btn" onclick="openPopup()">Do you know your BMI?</button>
</div>

<!-- Popup form for BMI calculator -->
<div id="popup-form" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2>BMI Calculator</h2>
        <label for="weight">Weight:</label>
        <input type="number" id="weight" name="weight" step="any" min="30" max="500">
        <select id="weight-unit">
            <option value="kg" selected>Kg</option>
            <option value="lbs">Lbs</option>
        </select>
        <br><br>
        <label for="height">Height:</label>
        <input type="number" id="height" name="height" step="any" min="100" max="250">
        <select id="height-unit">
            <option value="cm" selected>Cm</option>
            <option value="ft">Feet</option>
        </select>
        <br><br>
        <button value="Calculate" onclick="calculateBMI()">Calculate</button>
        <div id="result"></div>
        <div id="result1"></div>
    </div>
</div>

<script>
    // Open the popup form
    function openPopup() {
        document.getElementById("popup-form").style.display = "block";
    }

    // Close the popup form
    function closePopup() {
        document.getElementById("popup-form").style.display = "none";
    }

    // Calculate the BMI and display the result
    function calculateBMI() {
        var weightInput = document.getElementById("weight");
        var heightInput = document.getElementById("height");
        var weight = parseFloat(weightInput.value);
        var height = parseFloat(heightInput.value);
        var weightUnit = document.getElementById("weight-unit").value;
        var heightUnit = document.getElementById("height-unit").value;

        // Validate weight and height inputs
        if (isNaN(weight) || isNaN(height)) {
            document.getElementById("result").innerHTML = "<p>Please enter valid weight and height values.</p>";
            document.getElementById("result1").innerHTML = "";
            return;
        }

        // Convert weight to Kg if entered in Lbs
        if (weightUnit === "lbs") {
            weight = weight * 0.453592;
        }

        // Convert height to Cm if entered in Feet
        if (heightUnit === "ft") {
            height = height * 30.48;
        }

        // Check if weight or height is out of range
        if (weight < 30 || weight > 500 || height < 100 || height > 250) {
            document.getElementById("result").innerHTML = "<p>Please enter weight and height within the valid range.</p>";
            document.getElementById("result1").innerHTML = "";
            return;
        }

        var bmi = weight / ((height / 100) * (height / 100));
        document.getElementById("result").innerHTML = "<h2>Your BMI is: " + bmi.toFixed(2) + " " + getEmoji(bmi) + "</h2>";

        if (bmi < 18.5) {
            document.getElementById("result1").innerHTML = "<p>You are underweight. You should eat a balanced diet and do some weight training exercises to build muscle mass.</p><p>We recommend our <a href='http://localhost/Gym/web/register.php?packageId=2'> Gold Package.</p>";
        } else if (bmi >= 18.5 && bmi < 25) {
            document.getElementById("result1").innerHTML = "<p>You have a normal weight. You should maintain a healthy lifestyle by eating a balanced diet and doing regular exercise.</p><p>We recommend our <a href='http://localhost/Gym/web/register.php?packageId=1'>Silver Package.</a></p>";
        } else if (bmi >= 25 && bmi < 30) {
            document.getElementById("result1").innerHTML = "<p>You are overweight. You should reduce your calorie intake, eat a balanced diet, and do some aerobic exercise to burn calories.</p><p>We recommend our <a href='http://localhost/Gym/web/register.php?packageId=3'>Platinum Package.</p>";
        } else {
            document.getElementById("result1").innerHTML = "<p>You are obese. You should seek medical advice and make lifestyle changes such as reducing your calorie intake and doing regular exercise.</p>";
        }

        function getEmoji(bmi) {
            if (bmi < 18.5) {
                return "&#128531;"; // Sad emoji
            } else if (bmi >= 18.5 && bmi < 25) {
                return "&#128522;"; // Smiling emoji
            } else if (bmi >= 25 && bmi < 30) {
                return "&#128532;"; // Worried emoji
            } else {
                return "&#128557;"; // Angry emoji
            }
        }


    }
</script>





<main id="main">
    <section id="pricing" class="pricing">

        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Our Pricing</h2>
                <p>Every member gets a free, personalized Get Started Plan when they join. Our friendly, professional staff is trained to help you along your fitness journey, no matter how much support you need.</p>
            </div>



            <?Php
            $db = dbConn();
            $sql = "SELECT * FROM tbl_pricing WHERE Status=1";
            $result = $db->query($sql);
            ?>

            <div class="row gy-4">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>

                        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="400">
                            <div class="pricing-item featured">

                                <div class="pricing-header">
                                    <h3><?= $row['Package_Name'] ?></h3>
                                    <h4><sup>LKR</sup><?= number_format($row['Price']) ?></h4>
                                    <h5> <span> <?= $row['Months'] ?> Month</span></h5>
                                </div>

                                <ul>
                                    <li><i class="bi bi-dot"></i> <span><?= $row['Desc1'] ?></span></li>
                                    <li><i class="bi bi-dot"></i> <span><?= $row['Desc2'] ?></span></li>
                                    <li><i class="bi bi-dot"></i> <span><?= $row['Desc3'] ?></span></li>
                    <!--                <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span></li>
                                    <li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>-->
                                </ul>

                                <div class="text-center mt-auto">
                                    <a href="register.php?packageId=<?php echo $row['PricingId'] ?>" class="buy-btn">Enroll Now</a>
                                </div>

                            </div>
                        </div><!-- End Pricing Item -->
                        <?php
                    }
                }
                ?>



            </div>

        </div>
    </section>
</main>
<?php include 'footer.php'; ?>