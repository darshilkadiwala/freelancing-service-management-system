<?php
session_start();
if (isset($_GET) && $_GET['order'] && $_SESSION['RoleID'] != 1) {
	$sessRoleID = $_SESSION['RoleID'];
	require_once '../php/functions.php';
	require_once '../php/config.php';
	$orderid = test_input($_GET['order']);
	$sqlFindOrder = "";
	if ($sessRoleID == 3) {
		$sqlFindOrder = "SELECT `tblorderdetails`.*, `tblorderrequirement`.*, `tblcustomerpaymentdetails`.*, `tblservicedetail`.*, `tblservicecategories`.*, `tbluserpersonaldetails`.`Username` FROM `tblorderdetails` LEFT JOIN `tblorderrequirement` ON `tblorderrequirement`.`OrderID` = `tblorderdetails`.`OrderID` LEFT JOIN `tblcustomerpaymentdetails` ON `tblcustomerpaymentdetails`.`OrderID` = `tblorderdetails`.`OrderID` LEFT JOIN `tblservicedetail` ON `tblorderdetails`.`ServiceID` = `tblservicedetail`.`ServiceID` LEFT JOIN `tbluserpersonaldetails` ON `tblservicedetail`.`FreelancerID` = `tbluserpersonaldetails`.`UserID` LEFT JOIN `tblservicesubcategories` ON `tblservicedetail`.`ServiceSubcategoryID` = `tblservicesubcategories`.`ServiceSubcategoryID` LEFT JOIN `tblservicecategories` ON `tblservicesubcategories`.`ServiceCategoryID` = `tblservicecategories`.`ServiceCategoryID` WHERE `tblorderdetails`.`CustomerID`={$_SESSION['UserID']} AND `tblorderdetails`.`OrderID`={$orderid}";
	} else if ($sessRoleID == 2) {
		$sqlFindOrder = "SELECT `tblorderdetails`.*, `tblservicecategories`.*, `tblorderrequirement`.*, `tblservicedetail`.*, `tblcustomerpaymentdetails`.*, `tbluserpersonaldetails`.`Username` FROM `tblorderdetails` LEFT JOIN `tblorderrequirement` ON `tblorderrequirement`.`OrderID` = `tblorderdetails`.`OrderID` LEFT JOIN `tblservicedetail` ON `tblorderdetails`.`ServiceID` = `tblservicedetail`.`ServiceID` LEFT JOIN `tbluserpersonaldetails` ON `tblorderdetails`.`CustomerID` = `tbluserpersonaldetails`.`UserID` LEFT JOIN `tblservicesubcategories` ON `tblservicedetail`.`ServiceSubcategoryID` = `tblservicesubcategories`.`ServiceSubcategoryID` LEFT JOIN `tblservicecategories` ON `tblservicesubcategories`.`ServiceCategoryID` = `tblservicecategories`.`ServiceCategoryID` LEFT JOIN `tblcustomerpaymentdetails` ON `tblcustomerpaymentdetails`.`OrderID` = `tblorderdetails`.`OrderID` WHERE `tblservicedetail`.`FreelancerID`={$_SESSION['UserID']} AND `tblorderdetails`.`OrderID`={$orderid} ORDER BY `tblorderdetails`.`ID` DESC";
	}
	$queryFindOrder = mysqli_query($dbConn, $sqlFindOrder);
	if ($queryFindOrder && mysqli_num_rows($queryFindOrder) > 0) {
		$row = mysqli_fetch_assoc($queryFindOrder); ?>
		<!DOCTYPE html>
		<html>

		<head>
			<title>Order Summery | FSMS</title>
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
					<div class="row justify-content-center px-5">
						<div class="col-sm-10 mb-5">
							<h3 class="text-white h1 mb-3">Order Delivery </h3>
							<p class="card-text text-white-50 mx-3">ORDER ID : &nbsp;&nbsp;<?php echo "#" . $row['OrderID'];  ?></p>
							<div class="card rd-10 border-0">
								<div class="card-header">
									<div class="row mx-3 justify-content-between">
										<div class="col">
											<div class="row">
												<p class="card-text mx-3">ORDERED ON:<br /><?php echo date("M d, Y h:i A", strtotime($row['PaymentDateTime'])); ?></p>
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
									</div>
								</div>
								<div class="card-body flex-column">
									<?php if ($sessRoleID == 3) { ?>
										<div class="row mx-5 justify-content-between">
											<p class="h5 card-title">Payment: <strong><?php echo "<span class='text-success'>Successful</span>"; ?></strong></p>
											<p class="h5 card-title">Payment Mode:
												<strong>
													<?php echo $row['PaymentMode'] == "PPI"
														? "Wallet" : ($row['PaymentMode'] == "NB"
															? "Net Banking" : ($row['PaymentMode'] == "CC"
																? "Credit Card" : ($row['PaymentMode'] == "DC"
																	? "Debit Card" : ""))); ?>
												</strong>
											</p>
										</div>
									<?php } ?>
									<div class="row mx-5 justify-content-between">
										<p class="h5 card-title">Reqiurement Status:
											<strong>
												<?php echo $row['RequirementStatus'] == 'S' ? '<span class="text-success">Submitted</span>' : '<span class="text-danger">Pending</span>'; ?>
												<?php if ($row['RequirementStatus'] == 'P' && $sessRoleID == 3) { ?>
													<a class="Link font-weight-bold text-danger btn Btn6 border-0 m-2" href="./Submit-Requirement.php">Submit Requirement Now</a>
												<?php } ?>
											</strong>
										</p>
										<?php if ($sessRoleID == 3) { ?>
											<p class="h5 card-title">Bankname :
												<strong>
													<?php echo $row['BankName']; ?>
												</strong>
											</p>
										<?php } ?>
									</div>
									<hr>
								</div>

								<div class="row mx-5">
									<p class="h4 card-title">Servcie details</p>
								</div>
								<div class="row no-gutters mb-3 mx-5">
									<div class="col-auto">
										<div class="card border-0 mb-3" style="width:300px;">
											<img src="data:image;base64,<?php echo base64_encode($row['ServiceImage']); ?>" class="rd-10">
										</div>
									</div>
									<div class="col-md-7 mx-3">
										<div class="row no-gutters m-2">
											<a href="/FSMS/service.php?service=<?php echo $row['ServiceID']; ?>">
												<h4 class="card-title Link2"><b><?php echo $row['ServiceTitle']; ?></b></h4>
											</a>
											<p class="service-title"><?php echo $row['ServiceShortDescription']; ?></p>
										</div>
										<div class="card-footer">
											<div class="row mx-auto justify-content-between">
												<?php if ($sessRoleID == 3) { ?>
													<p class="card-text text-muted mx-3">Sold by: <em><?php echo $row['Username']; ?></em></p><?php } ?>
												<p class="card-text text-muted mx-3">Category: <?php echo "<i class='fa fa-tag mx-2'></i>" . $row['ServiceCategoryName']; ?></p>
											</div>
										</div>
									</div>
								</div>
								<hr class="row mx-5">
								<?php
								if ($row['DeliveryStatus'] == 'P' && $sessRoleID == 2) {
								?>
									<div class="row mx-5 no-gutters">
										<p class="h4 card-title">Upload Order</p>
									</div>
									<div class="row mx-5 mb-5 no-gutters">
										<form action="#" method="post">
											<input type="file" name="file" id="file" class="inputfile" />
											<label for="file" class="btn">Choose a file</label>
											<input type="hidden" name="order" value="<?php $row['OrderID']; ?>">
										</form>
									</div>
								<?php
								} else {
								?>
									<div class="row no-gutters mx-5">
										<div class="col-md-7 mx-3">
											<div class="row no-gutters m-2 flex-column">
												<div class="row m-0">
													<p class="service-title m-0"><u>About order:</u></p>
												</div>
												<div class="row m-0">
													<h4 class="card-title"><b><?php echo $row['AboutOrder']; ?></b></h4>
												</div>
												<div class="row m-0">
													<p class="service-title m-0"><u>Requirement:</u></p>
												</div>
												<div class="row m-0">
													<p class="service-title"><?php echo $row['Requirement']; ?></p>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			require_once "../widgets/footer.php";
			?>
			<script src="/FSMS/assets/js/main.js"></script>
			<script src="/FSMS/assets/js/scroll.js"></script>
		</body>

		</html>
<?php } else {
		header("Location: /FSMS/");
	}
} else {
	header("Location: /FSMS/");
}
