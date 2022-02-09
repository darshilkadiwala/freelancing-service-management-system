<?php
session_start();
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
	header("Location:/FSMS/Login.php");
} else if (isset($_POST['checkOutService']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['RoleID'] == 3) {
	require_once './php/config.php';
	$sqlFindPendingRequirement = "SELECT `OrderID` FROM `tblorderdetails` WHERE `CustomerID`={$_SESSION['UserID']} AND `RequirementStatus`='P'";
	$queryFindPendingRequirement = mysqli_query($dbConn, $sqlFindPendingRequirement);
	if ($queryFindPendingRequirement && mysqli_num_rows($queryFindPendingRequirement) > 0) {
		$row = mysqli_fetch_assoc($queryFindPendingRequirement);
		echo "<script>
				alert('Please submit requirement for your order #" . $row['OrderID'] . "');
				window.location.href='./order/submit-requirement.php';
			</script>";
	} else {
?>
		<!DOCTYPE html>
		<html lang="en">

		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Checkout | FSMS</title>
			<?php require_once './widgets/head-link.php'; ?>
		</head>

		<body class="bg-color-20c997">
			<?php
			$isCheckOut = true;
			$orderCheck = false;
			$payDone = false;
			$getReq = false;
			require_once './widgets/header.php';
			?>
			<div class="container container-lg container-md container-sm container-xl rd-10 bg-color-12192C mt-5">
				<div class="row p-5">
					<?php
					$sid = $_POST['sid'];
					$sqlService = "SELECT `tblservicedetail`.*, `tbluserpersonaldetails`.`Username`,`tblservicecategories`.`ServiceCategoryName` FROM `tblservicedetail`
				 LEFT JOIN `tblservicesubcategories` ON `tblservicedetail`.`ServiceSubcategoryID` = `tblservicesubcategories`.`ServiceSubcategoryID`
				 LEFT JOIN `tblservicecategories` ON `tblservicesubcategories`.`ServiceCategoryID` = `tblservicecategories`.`ServiceCategoryID`
				  LEFT JOIN `tbluserpersonaldetails` ON `tblservicedetail`.`FreelancerID` = `tbluserpersonaldetails`.`UserID` 
				  WHERE `tblservicecategories`.`CategoryStatus`='A' AND `tblservicedetail`.`ServiceID`={$sid}";
					$queryService = mysqli_query($dbConn, $sqlService);
					if (mysqli_num_rows($queryService) > 0) {
						while ($row = mysqli_fetch_array($queryService)) { ?>
							<div class="col-md-8 col-lg-8 col-sm-12 mb-5">
								<div class="card rd-10 border-0">
									<div class="card-header pb-0 rd-10 bg-color-F5A623">
										<h3 class="font-weight-bolder">Your Order</h3>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-5">
												<div class="card">
													<img src="data:image;base64,<?php echo base64_encode($row['ServiceImage']); ?>" class="rd-10">
												</div>
											</div>
											<div class="col-md-7">
												<h4 class="card-title"><b><?php echo $row['ServiceTitle']; ?></b></h4>
												<p class="service-title"><?php echo $row['ServiceShortDescription']; ?></p>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="row mx-auto justify-content-between">
											<p class="card-text text-muted mx-3">Sold by: <em><?php echo $row['Username']; ?></em></p>
											<p class="card-text text-muted mx-3">Price: <?php echo "<i class='bx bx-rupee'></i>" . number_format($row['ServiceCost'], 2); ?></p>
											<p class="card-text text-muted mx-3">Category: <?php echo "<i class='fa fa-tag mx-2'></i>" . $row['ServiceCategoryName']; ?></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-lg-4 col-sm-12">
								<div class="card rd-10 border-0">
									<div class="card-header pb-0 rd-10 bg-color-F5A623">
										<h3 class="font-weight-bolder">Summary</h3>
									</div>
									<div class="card-body pb-0">
										<div class="row px-3 justify-content-between">
											<p class="h6">Service level:</p>
											<p class="mb-0 h6 font-weight-bold"><?php echo $row['ServiceType'] == "B" ? "Beginner" : ($row['ServiceType'] == "A" ? "Advanced" : ($row['ServiceType'] == "M" ? "Medium" : "")); ?></p>
										</div>
										<div class="row px-3 justify-content-between">
											<p class="h6">Delivery Days</p>
											<p class="mb-0 h6 font-weight-bold"><?php echo $row['DeliveryDays'] . " Days" ?></p>
										</div>
										<hr />
										<div class="row px-3 justify-content-between">
											<p class="h6">Subtotal</p>
											<p class="mb-0 h6 font-weight-bold"><?php echo "<i class='bx bx-rupee'></i>" . number_format($row['ServiceCost'], 2); ?></p>
										</div>
										<div class="row px-3 justify-content-between">
											<p class="h6">Service fee</p>
											<p class="mb-0 h6 font-weight-bold">
												<?php $tax = number_format($row['ServiceCost'] * 5.00 / 100, 2);
												echo "<i class='bx bx-rupee'></i>" . $tax; ?></p>
										</div>
									</div>
									<div class="card-footer rd-10 color-12192C bg-color-ffc107">
										<div class="row px-3 justify-content-between">
											<p class="card-text font-weight-bold h5 mb-0">Total</p>
											<p class="card-text font-weight-bold mb-0 h5">
												<?php
												$totalCost = number_format($row['ServiceCost'] + $tax, 2);
												echo "<i class='bx bx-rupee'></i>" . $totalCost; ?></p>
										</div>
									</div>
								</div>
								<div class="m-3">
									<form method="post" id="frmCheckOutService">
										<input type="hidden" name="SERVICEID" id="SERVICEID" value="<?php echo $sid; ?>" />
										<input type="hidden" name="ORDID" id="ORDID" value="" />
										<input type="hidden" name="CUSTID" id="CUSTID" value="" />
										<input type="hidden" name="TXTAMOUNT" id="TXTAMOUNT" value="<?php echo number_format($row['ServiceCost'] + ($row['ServiceCost'] * 5.00 / 100), 2, ".", ""); ?>" />
										<input type="submit" value="Buy Now" name="btnCheckOutService" id="btnCheckOutService" class="btn Btn5 font-weight-bold size-sm" />
									</form>
								</div>
							</div>
					<?php
						}
					} ?>
				</div>
			</div>
			<script>
				custid = <?php echo $_SESSION['UserID'] ?>;
				
			</script>
			<script src="/FSMS/assets/js/checkout.js"></script>
			<script src="/FSMS/assets/js/scroll.js"></script>
		</body>

		</html>
<?php
	}
} else {
	header("Location:/FSMS/");
}
?>