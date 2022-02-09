<?php
session_start();
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true && $_SESSION['RoleID'] != 1)) {
	header("Location: /FSMS/");
} else {
	require_once '../php/config.php';
	require_once '../php/constants.php';
	require_once '../php/functions.php';
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Order History | FSMS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<?php
		require_once "../widgets/head-link.php";
		?>

	</head>

	<body>
		<?php
		require_once '../widgets/header.php';
		?>
		<div class="main-wrapper">
			<?php
			require_once "../widgets/sidebar.php";
			?>
			<div class="main-content bg-color-12192C" id="main-content">
				<div class="row justify-content-center p-5">
					<?php if ($_SESSION['RoleID'] == 3) { ?>
						<?php
						$sqlPurchasedService = "SELECT `tblorderdetails`.*, `tblcustomerpaymentdetails`.*, `tblservicedetail`.*, `tblservicesubcategories`.*, `tblservicecategories`.*, `tbluserpersonaldetails`.`Username` FROM `tblorderdetails` LEFT JOIN `tblcustomerpaymentdetails` ON `tblcustomerpaymentdetails`.`OrderID` = `tblorderdetails`.`OrderID` LEFT JOIN `tblservicedetail` ON `tblorderdetails`.`ServiceID` = `tblservicedetail`.`ServiceID` LEFT JOIN `tbluserpersonaldetails` ON `tblservicedetail`.`FreelancerID` = `tbluserpersonaldetails`.`UserID` LEFT JOIN `tblservicesubcategories` ON `tblservicedetail`.`ServiceSubcategoryID` = `tblservicesubcategories`.`ServiceSubcategoryID` LEFT JOIN `tblservicecategories` ON `tblservicesubcategories`.`ServiceCategoryID` = `tblservicecategories`.`ServiceCategoryID` WHERE `tblorderdetails`.`CustomerID`={$_SESSION['UserID']} ORDER BY `tblorderdetails`.`ID` DESC";

						$queryPurchasedService = mysqli_query($dbConn, $sqlPurchasedService);
						if (mysqli_num_rows($queryPurchasedService) > 0) {
							while ($row = mysqli_fetch_array($queryPurchasedService)) { ?>
								<div class="col-sm-10 mb-5">
									<div class="card rd-10 border-0">
										<div class="card-header pb-0">
											<div class="row mx-3 justify-content-between">
												<div class="col">
													<div class="row">
														<p class="card-text mx-3">ORDERED ON:<br /><?php echo date("M d, Y", strtotime($row['PaymentDateTime'])); ?></p>
														<?php if ($row['DeliveryStatus'] == 'P') { ?>
															<p class="card-text mx-3">DELIVER ON OR BEFORE:<br />
																<?php
																$deliveryDate = date("M d, Y", strtotime($row['PaymentDateTime'] . "+" . $row['DeliveryDays'] . " days"));
																$checkDate = strcmp(date("M d,Y"), $deliveryDate);
																echo $checkDate > 1
																	? "<span class='text-danger font-weight-bolder'>" . $deliveryDate . "</span>"
																	: ($checkDate == 1
																		? "<span class='text-danger font-weight-bolder'>Today</span>"
																		: date("M d, Y", strtotime($row['PaymentDateTime'] . "+" . $row['DeliveryDays'] . " days")));
																?>
															</p>
														<?php } ?>
														<p class="card-text mx-3">DELIVERY STATUS:<br />
															<?php echo $row['DeliveryStatus'] == 'P'
																? "<span class='text-danger font-weight-bolder'>Pending</span>"
																: ($row['DeliveryStatus'] == 'S'
																	? "<span class='text-success font-weight-bolder'>Delivered</span>"
																	: "");  ?>
														</p>
														<p class="card-text mx-3">TOTAL:<br /><?php echo "<i class='bx bx-rupee'></i>" . number_format($row['PayableAmount'], 2);  ?></p>
													</div>
												</div>
												<div class="col-auto">
													<div class="row">
														<p class="card-text mx-3">ORDER ID:<br /><?php echo "#" . $row['OrderID'];  ?></p>
													</div>
												</div>
											</div>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-auto">
													<div class="card border-0 mb-3" style="width:300px;">
														<img src="data:image;base64,<?php echo base64_encode($row['ServiceImage']); ?>" class="rd-10">
													</div>
												</div>
												<div class="col-md-7">
													<div class="row">
														<h4 class="card-title"><b><?php echo $row['ServiceTitle']; ?></b></h4>
														<p class="service-title"><?php echo $row['ServiceShortDescription']; ?></p>
													</div>
													<div class="row justify-content-between d-flex flex-column">
														<p class="service-title">Reqiurement Status: <?php echo $row['RequirementStatus'] == 'S' ? "<span class='text-danger font-weight-bolder'>Submitted</span>" : "<span class='text-danger font-weight-bolder'>Pending</span>"; ?></p>
														<?php if ($row['RequirementStatus'] == 'P') { ?>
															<a class="font-weight-bold text-danger btn Btn6 border-0 m-2" href="./Submit-Requirement.php">Submit Requirement Now</a>
														<?php } ?>
														<a class="font-weight-bold btn Btn1 border-0 m-2" href="./view-order-summery.php?order=<?php echo $row['OrderID']; ?>">View Order Details</a>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>

							<?php
							}
						} else {
							?>
							<div class="col justify-content-center d-lg-flex h-100">
								<h1 class="color-EDEDED">Sorry! You have not purchade any service . . .</h1>
							</div>
						<?php
						} ?>
						<?php
					} else if ($_SESSION['RoleID'] == 2) {
						$sqlPurchasedService = "SELECT `tblorderdetails`.*, `tblservicedetail`.*, `tblcustomerpaymentdetails`.*, `tbluserpersonaldetails`.`Username` FROM `tblorderdetails` LEFT JOIN `tblservicedetail` ON `tblorderdetails`.`ServiceID` = `tblservicedetail`.`ServiceID` LEFT JOIN `tbluserpersonaldetails` ON `tblorderdetails`.`CustomerID` = `tbluserpersonaldetails`.`UserID` LEFT JOIN `tblcustomerpaymentdetails` ON `tblcustomerpaymentdetails`.`OrderID` = `tblorderdetails`.`OrderID`  WHERE `tblservicedetail`.`FreelancerID`={$_SESSION['UserID']} ORDER BY `tblorderdetails`.`ID` DESC";

						$queryPurchasedService = mysqli_query($dbConn, $sqlPurchasedService);
						if (mysqli_num_rows($queryPurchasedService) > 0) {
							while ($row = mysqli_fetch_array($queryPurchasedService)) { ?>
								<div class="col-sm-10 mb-5">
									<div class="card rd-10 border-0">
										<div class="card-header pb-0">
											<div class="row mx-3 justify-content-between">
												<div class="col">
													<div class="row">
														<p class="card-text mx-3">ORDERED ON:<br /><?php echo date("M d, Y", strtotime($row['PaymentDateTime'])); ?></p>
														<?php if ($row['DeliveryStatus'] == 'P') { ?>
															<p class="card-text mx-3">DELIVER ON OR BEFORE:<br />
																<?php
																$deliveryDate = date("M d, Y", strtotime($row['PaymentDateTime'] . "+" . $row['DeliveryDays'] . " days"));
																$checkDate = strcmp(date("M d,Y"), $deliveryDate);
																echo $checkDate > 1
																	? "<span class='text-danger font-weight-bolder'>" . $deliveryDate . "</span>"
																	: ($checkDate == 1
																		? "<span class='text-danger font-weight-bolder'>Today</span>"
																		: date("M d, Y", strtotime($row['PaymentDateTime'] . "+" . $row['DeliveryDays'] . " days")));
																?>
															</p>
														<?php } ?>
														<p class="card-text mx-3">DELIVERY STATUS:<br />
															<?php echo $row['DeliveryStatus'] == 'P'
																? "<span class='text-danger font-weight-bolder'>Pending</span>"
																: ($row['DeliveryStatus'] == 'S'
																	? "<span class='text-success font-weight-bolder'>Delivered</span>"
																	: "");  ?>
														</p>
													</div>
												</div>
												<div class="col-auto">
													<div class="row">
														<p class="card-text mx-3">ORDER ID:<br /><?php echo "#" . $row['OrderID'];  ?></p>
													</div>
												</div>
											</div>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-auto">
													<div class="card border-0 mb-3" style="width:300px;">
														<img src="data:image;base64,<?php echo base64_encode($row['ServiceImage']); ?>" class="rd-10">
													</div>
												</div>
												<div class="col-md-7">
													<div class="row">
														<h4 class="card-title"><b><?php echo $row['ServiceTitle']; ?></b></h4>
														<p class="service-title"><?php echo $row['ServiceShortDescription']; ?></p>
													</div>
													<div class="row justify-content-between d-flex flex-column">
														<p class="service-title">Reqiurement Status: <?php echo $row['RequirementStatus'] == 'S' ? "<span class='text-danger font-weight-bolder'>Submitted</span>" : "<span class='text-danger font-weight-bolder'>Pending</span>"; ?></p>
														<a class=" font-weight-bold btn Btn1 border-0 m-2" href="./view-order-summery.php?order=<?php echo $row['OrderID']; ?>">View Order Details</a>
														<a class=" font-weight-bold btn Btn5 border-0 m-2" href="./order-deliver.php?order=<?php echo $row['OrderID']; ?>">Deliver Order</a>
														<a class="Link font-weight-bold btn Btn6 border-0 m-2" href="/FSMS/chat/users.php?rname=<?php echo $row['Username']; ?>">Chat With Customer</a>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
					<?php	}
						}
					} ?>
				</div>
			</div>
		</div>
		<?php
		require_once "../widgets/footer.php";
		?>
		<script src="/FSMS/assets/js/main.js	"></script>
		<script src="/FSMS/assets/js/scroll.js"></script>
	</body>

	</html>
<?php } ?>