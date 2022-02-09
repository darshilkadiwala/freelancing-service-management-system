<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function test_password_input($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function genrateOTP()
{
    return rand(111111, 999999);
}

function sendEmail($subject, $messageBody, $emailID, $name, $sendMail)
{
    $sendMail->isSMTP();
    $sendMail->Host = "smtp.gmail.com";
    $sendMail->SMTPAuth = "true";
    $sendMail->SMTPSecure = "tls";
    $sendMail->Port = "587";
    $sendMail->Username = "change your email here";
    $sendMail->Password = "**********";
    $sendMail->setFrom("18bmiit084@gmail.com", "Admin of Freelancing Service Management System");
    $sendMail->isHTML();
    $temp = false;
    if (
        isset($subject) && isset($messageBody) && isset($emailID) &&
        !empty($subject) && !empty($messageBody) && !empty($emailID)
    ) {
        $sendMail->Subject = $subject;
        $sendMail->Body = $messageBody;
        // $sendMail->addAddress($emailID, $name);
        $sendMail->addAddress($emailID);

        if (!$sendMail->send()) {
            $temp = false;
        } else {
            $temp =  true;
        }
    }
    $sendMail->smtpClose();
    return $temp;
}

function viewServiceCard($userID = null, $limit = null, $except = null, $serviceID = null)
{
    global $dbConn;
    $sqlService = "SELECT `tblservicedetail`.*, `tblservicesubcategories`.`ServiceCategoryID`, `tblservicecategories`.`ServiceCategoryID`, `tbluserpersonaldetails`.`Username`, `tbluserpersonaldetails`.`ProfilePicture`, `tblservicecategories`.`ServiceCategoryName` FROM `tblservicedetail` LEFT JOIN `tblservicesubcategories` ON `tblservicedetail`.`ServiceSubcategoryID` = `tblservicesubcategories`.`ServiceSubcategoryID` LEFT JOIN `tblservicecategories` ON `tblservicesubcategories`.`ServiceCategoryID` = `tblservicecategories`.`ServiceCategoryID` LEFT JOIN `tbluserpersonaldetails` ON `tblservicedetail`.`FreelancerID` = `tbluserpersonaldetails`.`UserID` WHERE `tblservicecategories`.`CategoryStatus`='A'";
    $totalServices = 0;
    if (!empty($serviceID)) {
        $sqlService .= " AND `tblservicedetail`.`ServiceID`={$serviceID}";
    }
    if (!empty($userID)) {
        $sqlService .= " AND `tblservicedetail`.`FreelancerID`={$userID} ";
    }
    if (!empty($except)) {
        $sqlService .= " AND `tblservicedetail`.`ServiceID` NOT IN ('{$except}') ";
    }
    $sqlService .= " ORDER BY RAND() ";
    if (!empty($limit)) {
        $sqlService .= "LIMIT {$limit}";
    }
    // echo $sqlService;
    $queryService = mysqli_query($dbConn, $sqlService);
    if (mysqli_num_rows($queryService) > 0) {
        while ($row = mysqli_fetch_array($queryService)) {
            if (!empty($userID)) {
                $totalServices++;
            }
            if (!empty($except)) {
                echo "<h2>More From this seller</h2>";
            }
            echo "<div class='mycard'>
                <div class='mycard-service-img'>
                    <img src='data:image;base64," . base64_encode($row['ServiceImage']) . "' width='300px' />
                </div>
                <div class='mycard-info'>
                    <div class='mycard-user-info'>
                        <div class='username'>
                            " . $row['Username'] . "
                        </div>
                        <div class='user-profile'>
                            <img src='data:image/jpeg;base64," . base64_encode($row['ProfilePicture']) . "' height='200px' />
                        </div>
                    </div>
                    <div class='mycard-text'>
                        <div class='mycard-title'>
                            <a href='/FSMS/service.php?service=" . $row['ServiceID'] . "'>" . $row['ServiceTitle'] . "</a>
                        </div>
                        <div class='mycard-short-desc'>" . $row['ServiceShortDescription'] . "</div>
                    </div>
                    <div class='mycard-price '> STARTING AT ₹ " . $row['ServiceCost'] . "</div>
                </div>
            </div>";

            if (!empty($userID) && empty($serviceID)) {
                echo "<script>$('#totalServices').html('Total service listed: '+$totalServices)</script>";
            }
        }
    }
}

function viewServiceDetails($sid)
{
    global $dbConn;
    // $sqlService = "SELECT `tblservicedetail`.*, `tbluserpersonaldetails`.`Username` AS `Username`,`tbluserpersonaldetails`.`ProfilePicture` AS `ProfilePicture` FROM `tblservicedetail` LEFT JOIN `tbluserpersonaldetails` ON `tblservicedetail`.`FreelancerID` = `tbluserpersonaldetails`.`UserID`";
    $sqlService = "SELECT `tblservicedetail`.*, `tbluserpersonaldetails`.*, `tblfreelancerprofessionaldetails`.*,`tblcity`.*, `tblstate`.* FROM `tblservicedetail` 
    LEFT JOIN `tblservicesubcategories` ON `tblservicedetail`.`ServiceSubcategoryID` = `tblservicesubcategories`.`ServiceSubcategoryID` 
    LEFT JOIN `tblservicecategories` ON `tblservicesubcategories`.`ServiceCategoryID` = `tblservicecategories`.`ServiceCategoryID` 
    LEFT JOIN `tbluserpersonaldetails` ON `tblservicedetail`.`FreelancerID` = `tbluserpersonaldetails`.`UserID` 
    LEFT JOIN `tblfreelancerprofessionaldetails` ON `tblservicedetail`.`FreelancerID` = `tblfreelancerprofessionaldetails`.`FreelancerID` 
    LEFT JOIN `tblcity` ON `tbluserpersonaldetails`.`CityID`= `tblcity`.`CityID`
    LEFT JOIN `tblstate` ON `tblcity`.`StateID`= `tblstate`.`StateID` WHERE `tblservicecategories`.`CategoryStatus`='A' AND `tblservicedetail`.`ServiceID`={$sid}";

    $queryService = mysqli_query($dbConn, $sqlService);
    if (mysqli_num_rows($queryService) > 0) {
        while ($row = mysqli_fetch_array($queryService)) { ?>
            <div class="row m-0 justify-content-between">
                <h1 class="service-title"><b><?php echo $row['ServiceTitle']; ?></b></h1>
                <?php if (isset($_SESSION['UserID']) && $row['UserID'] == $_SESSION['UserID']) { ?>
                    <a class="font-weight-bold Btn6 py-3" href="/FSMS/dashboard/services/edit-service.php?serivce=<?php echo $row['ServiceID']; ?>">Edit Service</a>
                <?php } ?>
            </div>
            <hr class="border-white col-11 mb-3" />
            <div class="service-container">
                <div class="service-row">
                    <div class="service-col">
                        <div class="mySlides">
                            <!-- <div class="numbertext">1 / 6</div> -->
                            <img src="data:image;base64,<?php echo base64_encode($row['ServiceImage']); ?>" class="rd-10">
                        </div>
                        <div class="service-short-desc">
                            <h2 class="service-short-desc-heading">Short Description</h2>
                            <p class="service-short-desc-text"><?php echo $row['ServiceShortDescription']; ?></p>
                        </div>
                        <div class="service-about">
                            <h2 class="service-about-heading">About this service</h2>
                            <p class="service-about-text"><?php echo $row['AboutService']; ?></p>
                            <div class="service-about-date">
                                <h4 class="service-about-date-heading">Last updated on</h4>
                                <?php $lastupdateDate = new DateTime($row['LastUpdated']);
                                echo $lastupdateDate->format('M d, Y');
                                ?>
                            </div>
                        </div>
                        <div class="service-seller">
                            <h2 class="service-seller-heading">About seller</h2>
                            <div class="seller-info">
                                <div class="seller-profile">
                                    <div class="seller-profile-img">
                                        <img src="data:image;base64,<?php echo base64_encode($row['ProfilePicture']) ?>" alt="Profile">
                                    </div>
                                    <div class="seller-profile-label">
                                        <div class="username"><a href="./user.php?UserID=<?php echo $row['UserID']; ?>" class="Link3"><?php echo $row['Username']; ?></a></div>
                                        <div class="occupation"><?php echo $row['Occupation']; ?>
                                            <div class="rating-wrapper"><span class="star-rating-s15 rate-10"></span>
                                                <!-- <p class="rating-text"><strong>5.0</strong> (228 reviews)</p> -->
                                            </div>
                                        </div>
                                        <a class="btn Btn1" href="./chat/users.php?rname=<?php echo $row['Username']; ?>">Contact me</a>
                                    </div>
                                </div>
                                <div class="stats-desc">
                                    <ul class="user-stats">
                                        <li>From<strong><?php echo $row['CityName'] . ", " . $row['StateName'] ?></strong></li>
                                        <li>Member since<strong>
                                                <?php
                                                $date = new DateTime($row['DateOfJoining']);
                                                echo $date->format('M, Y');
                                                ?></strong></li>
                                    </ul>
                                    <article class="seller-about"><?php echo $row['About'] ?>
                                    </article>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="service-col-auto">
                        <div class="wrap-table100">
                            <div class="table100">
                                <table class="content-table">
                                    <thead>
                                        <th>Service Type</th>
                                        <th>Price</th>
                                        <th>Delivery Days</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['ServiceType'] == "B" ? "Beginner" : ($row['ServiceType'] == "A" ? "Advanced" : ($row['ServiceType'] == "M" ? "Medium" : "")); ?></td>
                                            <td><?php echo $row['ServiceCost']; ?></td>
                                            <td><?php echo $row['DeliveryDays']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="buttons">
                            <form action="checkout.php" method="post">
                                <input type="hidden" name="sid" value="<?php echo $row['ServiceID']; ?>" />
                                <input type="submit" value="Buy Now" name="checkOutService" class="btn Btn5" />
                            </form>
                        </div>
                        <div class="mt-5">
                            <?php viewServiceCard($row['UserID'], 3, $row['ServiceID']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.title = "<?php echo ucwords($row['ServiceTitle']) ?>";
            </script>
<?php
        }
    }
}
?>