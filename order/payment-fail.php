<?php
session_start();
if (isset($_SESSION['SERVICEID'])) {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Payment Fail | FSMS</title>
		<?php require_once '../widgets/head-link.php'; ?>
		<style>
			body {
				font-family: 'Varela Round', sans-serif;
			}

			.modal {
				position: relative;
			}

			.modal-confirm {
				color: #EDEDED;
				width: 325px;
			}

			.modal-confirm .modal-content {
				padding: 20px;
				border-radius: 5px;
				border: none;
			}

			.modal-confirm .modal-header {
				border-bottom: none;
				position: relative;
			}

			.modal-confirm h4 {
				text-align: center;
				font-size: 26px;
				margin: 30px 0 -15px;
			}

			.modal-confirm .form-control,
			.modal-confirm .btn {
				min-height: 40px;
				border-radius: 3px;
			}

			.modal-confirm .close {
				position: absolute;
				top: -5px;
				right: -5px;
			}

			.modal-confirm .modal-footer {
				border: none;
				text-align: center;
				border-radius: 5px;
				font-size: 13px;
			}

			.modal-confirm .icon-box {
				color: #fff;
				position: absolute;
				margin: 0 auto;
				left: 0;
				right: 0;
				top: -70px;
				width: 95px;
				height: 95px;
				border-radius: 50%;
				z-index: 9;
				background: #F5A623;
				padding: 15px;
				text-align: center;
				box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
			}

			.modal-content {
				background-color: #12192C;
			}

			.modal-confirm .icon-box i {
				font-size: 56px;
				position: relative;
				top: 4px;
			}

			.modal-confirm.modal-dialog {
				margin-top: 80px;
			}

			.modal-confirm .btn {
				color: #fff;
				border-radius: 4px;
				background: #F5A623;
				text-decoration: none;
				transition: all 0.4s;
				line-height: normal;
				border: none;
			}

			.modal-confirm .btn:hover,
			.modal-confirm .btn:focus {
				background: #F5A623;
				outline: none;
			}

			.trigger-btn {
				display: inline-block;
				margin: 100px auto;
			}
		</style>
	</head>

	<body>
		<?php
		$isCheckOut = true;
		$orderCheck = true;
		$payDone = true;
		$paySucess = $_POST["STATUS"] == "TXN_SUCCESS" ? true : false;
		$getReq = false;
		require_once '../widgets/header.php'; ?>
		<div class="modal fade show" style="display: block;" aria-modal="true">
			<div class="modal-dialog modal-confirm">
				<div class="modal-content">
					<div class="modal-header">
						<div class="icon-box">
							<i class="bx bx-x font-weight-bold"></i>
						</div>
						<h4 class="modal-title w-100">Sorry!</h4>
					</div>
					<div class="modal-body">
						<p class="text-center">Your transaction has failed. Please go back and try again.</p>
					</div>
					<div class="modal-footer">
						<form action="<?php echo "/FSMS/service.php?service=" . $_SESSION['SERVICEID']; ?>" class="col" method="post">
							<input type="submit" class="btn btn-block" value="OK" />
						</form>
						<?php
						unset($_SESSION['SERVICEID']);
						?>
					</div>
				</div>
			</div>
		</div>
	</body>

	</html>
<?php } else {
	header("Location:/FSMS/");
} ?>