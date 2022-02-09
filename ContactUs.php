<!DOCTYPE html>
<html>

<head>
    <meta charset="utu-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us page</title>
    <?php
    require_once "./widgets/head-link-contactus.php";
    ?>

</head>

<body>
    <?php
    session_start();
    require_once './php/config.php';
    require_once './widgets/header.php';
    ?>
    <section>
        <div class="section">
            <div class="container1">
                <div class="contactinfo contactInfo">
                    <div>
                        <h2>Contact at</h2>
                        <ul class="info">
                            <li>
                                <span><img src="/FSMS/assets/icon/images/location.png"></span>
                                <span>A-4/F-3 Hirachand Nagar,<br>
                                    Station Road,<br>
                                    Bardoli-394601 <br></span>
                            </li>
                            <li>
                                <span><img src="/FSMS/assets/icon/images/mail.png"></span>
                                <span>lorem@gmail.com</span>
                            </li>
                            <li>
                                <span><img src="/FSMS/assets/icon/images/call.png"></span>
                                <span>+91 9825226880</span>
                            </li>
                        </ul>
                    </div>
                    <div class="sci">

                        <h2>Follow us</h2>
                        <ul>
                            <li>
                                <a href=""><img src="/FSMS/assets/icon/images/1.png" alt=""></a>
                            </li>
                            <li>
                                <a href="#"><img src="/FSMS/assets/icon/images/2.png" alt=""></a>
                            </li>
                            <li>
                                <a href="#"><img src="/FSMS/assets/icon/images/3.png" alt=""></a>
                            </li>
                            <li>
                                <a href="#"><img src="/FSMS/assets/icon/images/4.png" alt=""></a>
                            </li>
                            <li>
                                <a href="#"><img src="/FSMS/assets/icon/images/5.png" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="show-msg"></div> -->
                <form action="#" method="post">
                    <div class="contactForm">
                        <h2>Send a Message</h2>
                        <div class="formBox">
                            <div class="inputBox w50">
                                <input type="text" name="txtFname" required>
                                <span>First Name</span>
                            </div>
                            <div class="inputBox w50">
                                <input type="text" name="txtLname" required>
                                <span>Last Name</span>
                            </div>
                            <div class="inputBox w50">
                                <input type="email" name="txtEmail" required>
                                <span>Email Address</span>
                            </div>
                            <div class="inputBox w50">
                                <input type="number" name="txtContact" maxlength="10" required>
                                <span>Mobile Number</span>
                            </div>
                            <div class="inputBox w100">
                                <textarea name="txtMessage" required></textarea>
                                <span>Write Your Message Here....</span>
                            </div>
                            <div class="inputBox w100">
                                <input type="submit" name="submit-btn" value="Send">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php

    if (isset($_POST['submit-btn'])) {

        $fname = $_POST['txtFname'];
        $lname = $_POST['txtLname'];
        $mnumber = $_POST['txtContact'];
        $email = $_POST['txtEmail'];
        $message = $_POST['txtMessage'];

        $sqlRegister = "INSERT INTO `tblcontactinfo` (`FirstName`,`LastName`,`ContactNo`,`Email`,`Message`)
        VALUES ('$fname', '$lname', '$mnumber', '$email', '$message')";
        $query = mysqli_query($dbConn, $sqlRegister);

        if ($query) {
            // echo "<script>window.location.href='../Login.php'</script>";
            echo "<script>$('.show-msg').html('Your query is submitted ...')</script>";
        }
    }
    ?>

    <?php
    require_once './widgets/footer.php';
    ?>
    <script src="/FSMS/assets/js/scroll.js"></script>
</body>

</html>