<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

if (isset($_POST) && count($_POST) > 0) {
	require_once("./lib/config_paytm.php");
	require_once("./lib/encdec_paytm.php");

	$paytmChecksum = "";
	$paramList = array();
	$isValidChecksum = "FALSE";

	$paramList = $_POST;
	$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

	//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
	$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
?>
	<center>
		<h1>Please do not refresh this page...</h1>
		<?php
		if ($isValidChecksum == "TRUE") {
			echo "<h3>Checksum matched and you will redirected automatically...</h3>" . "<br/>";
			if ($_POST["STATUS"] == "TXN_SUCCESS") {
				$redirectURL = "/FSMS/order/payment-done.php";
			} else {
				$redirectURL = "/FSMS/order/payment-fail.php";
			}
		?>
			<form method="post" action="<?php echo $redirectURL ?>" name="f1">
				<?php
				foreach ($paramList as $name => $value) {
					echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
				}
				?>
				<input type="hidden" name="CHECKSUMHASH" value="<?php echo $paytmChecksum ?>">
			</form>
			<script type="text/javascript">
				document.f1.submit();
			</script>
	<?php
		} else {
			echo "<h1>Checksum mismatched.</h1></center>";
		}
	} else {
		header("Location:/FSMS/");
	}
