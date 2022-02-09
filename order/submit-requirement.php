<?php
session_start();
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
	header("Location:/FSMS/Login.php");
} else if ($_SESSION['RoleID'] == 3) {
?>
	<html>

	<head>
		<title>Submit Requirement | FSMS</title>
		<?php require_once '../widgets/head-link.php'; ?>
		<link rel="stylesheet" type="text/css" href="/FSMS/assets/css/card.css">
		<link rel="stylesheet" type="text/css" href="/FSMS/assets/css/service-details.css">
	</head>
	</head>

	<body class="bg-color-EDEDED">
		<?php
		$isCheckOut = true;
		$orderCheck = true;
		$payDone = true;
		$paySucess = true;
		$getReq = false;
		require_once '../php/functions.php';
		require_once '../widgets/header.php';
		?>
		<div class="main-wrapper rd-10">
			<div class="main-content" id="main-content">
				<div class="row rd-10 justify-content-md-center shadow-lg mr-5 bg-white color-12192C">
					<?php $sqlPendingReq = "SELECT `tblorderdetails`.`OrderID`, `tblservicedetail`.* FROM `tblorderdetails` LEFT JOIN `tblservicedetail` ON `tblorderdetails`.`ServiceID` = `tblservicedetail`.`ServiceID` WHERE `tblorderdetails`.`RequirementStatus`='P' AND `tblorderdetails`.`CustomerID`={$_SESSION['UserID']}";
					$queryPendingReq = mysqli_query($dbConn, $sqlPendingReq);
					if ($queryPendingReq && mysqli_num_rows($queryPendingReq) > 0) {
						while ($row = mysqli_fetch_assoc($queryPendingReq)) { ?>
							<div class="col-12 m-auto px-5 pr-3 py-4">
								<div class="row mb-3">
									<div class="col-auto m-auto">
										<h1 class="align-self-center text-center font-weight-bold pt-4">Submit your order requirement</h1>
										<h5 class="align-self-center text-center">This will help freelancer to complete your order</h5>
									</div>
								</div>
									<hr />
								<div class="row justify-content-center">
									<div class="col-auto col-sm-auto mb-5">
										<div class="mycard-container d-flex flex-column">
											<h4>Service you have ordered</h4>
											<?php viewServiceCard(null, null, null, $row['ServiceID']); ?>
										</div>
									</div>
									<div class="col-8 col-xl mt-3">
										<p class="text-muted m-0">Order ID : <?php echo "#" . $row['OrderID']; ?></p>
										<p class="text-muted">Payment Status : Success</p>
										<form class="form" id="frmSubmitRequirement" action="" method="POST" autocomplete="off">
											<div class="mx-2">
												<div class="form-row">
													<label for="txtAboutOrder" ID="lblAboutOrder" class="mb-1 ml-1 color-12192C font-weight-bold">Tell about why your order this
														<small>(In Short) <small>(max 100 characters)</small></small> :</label>
													<input type="text" ID="txtAboutOrder" name="txtAboutOrder" title="Tell about your order" class="form-control mb-1 p-4" placeholder="About your order" maxlength="100" required value="<?php echo isset($_POST['txtAboutOrder']) ? $_POST['txtAboutOrder'] : ""; ?>" />
													<span class="error-msg" id='errAboutOrder'></span>
												</div>
												<div class="form-row mt-3">
													<label for="txtRequirement" ID="lblRequirement" class="mb-1 ml-1 color-12192C font-weight-bold">Your requirement <small>(In detail) <small>(also specify link if neccessery)</small></small> :</label>
													<textarea type="text" ID="txtRequirement" name="txtRequirement" title="Your requirement (In detail)" rows="3" class="form-control mb-1 px-4 py-3" placeholder="Your requirements" required><?php echo isset($_POST['txtRequirement']) ? $_POST['txtRequirement'] : ""; ?></textarea>
													<span class="error-msg" id='errRequirement'></span>
												</div>
												<div class="form-row mt-3">
													<label for="ReqImg" ID="lblReqImg" class="mb-1 ml-1 color-12192C font-weight-bold">Upload file here if you have <small>(optional)</small> :</label>
												</div>
												<input type="file" ID="ReqImg" name="ReqImg" />
												<div class="form-row justify-content-center mt-3">
													<div class="loadingButton">
														<input type="hidden" name="OrderID" value="<?php echo $row['OrderID'] ?>">
														<input type="submit" ID="btnSubmitRequirement" name="SubmitRequirement" class="btn btn-block Btn mt-2 shadow" value="Submit Requirement" />
													</div>
												</div>
											</div>
											<div class="form-row">
												<div class="col-auto justify-content-center mt-3">
													<div class="error-msg" id="error-msg"></div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
					<?php }
					} else {
						header("Location:/FSMS/order/");
					}
					?>
				</div>
			</div>
		</div>
		<?php require_once '../widgets/footer.php'; ?>
		<script src="/FSMS/assets/js/order/submit-requirement.js"></script>
	</body>

	</html>
<?php
} else {
	header("Location:/FSMS/");
}
?>