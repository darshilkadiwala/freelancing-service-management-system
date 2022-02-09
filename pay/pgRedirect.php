<?php
session_start();
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
	header("Location:/FSMS/Login.php");
} else if (isset($_POST['ORDID']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");
	// following files need to be included
	require_once("./lib/config_paytm.php");
	require_once("./lib/encdec_paytm.php");

	$checkSum = "";
	$paramList = array();

	$ORDER_ID = $_POST["ORDID"];
	$CUST_ID = $_POST["CUSTID"];
	$TXN_AMOUNT = $_POST["TXTAMOUNT"];
	$_SESSION['SERVICEID'] = $_POST["SERVICEID"];

	// Create an array having all required parameters for creating checksum.
	$paramList["MID"] = PAYTM_MERCHANT_MID;
	$paramList["ORDER_ID"] = $ORDER_ID;
	$paramList["CUST_ID"] = $CUST_ID;
	$paramList["INDUSTRY_TYPE_ID"] = "Retail";
	$paramList["CHANNEL_ID"] = "WEB";
	$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
	$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;

	$paramList["CALLBACK_URL"] = "http://localhost/FSMS/pay/pgResponse.php";
	/*
$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
$paramList["EMAIL"] = $EMAIL; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

*/

	//Here checksum string will return by getChecksumFromArray() function.
	$checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);

?>
	<html>

	<head>
		<title>Check Out | FSMS</title>
		<?php require_once '../widgets/head-link.php'; ?>
	</head>
	</head>

	<body><?php
			$isCheckOut = true;
			$orderCheck = true;
			$payDone = false;
			$getReq = false;
			require_once '../widgets/header.php'; ?>
		<center>
			<h1>Please do not refresh this page...</h1>
		</center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
			<table border="1">
				<tbody>
					<?php
					foreach ($paramList as $name => $value) {
						echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
					}
					?>
					<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
				</tbody>
			</table>
			<script type="text/javascript">
				document.f1.submit();
			</script>
		</form>
	</body>

	</html>
<?php
} else {
	header("Location:/FSMS/");
}
?>