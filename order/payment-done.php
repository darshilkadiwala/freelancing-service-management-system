<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
session_start();
if (isset($_SESSION['SERVICEID']) && isset($_POST) && count($_POST) > 0) {
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		$paramList = $_POST;
		if (!(isset($_SESSION['PAYINSERTDONE']) && $_SESSION['PAYINSERTDONE'] == true &&
			isset($_SESSION['ORDERINSERTDONE']) && $_SESSION['ORDERINSERTDONE'] == true)) {
			require_once '../php/config.php';
			$discountID = isset($_SESSION['DiscountID']) ? $_SESSION['DiscountID'] : "";
			$txnStatus = $paramList["STATUS"] == "TXN_SUCCESS" ? 'S' : 'F';

			$sqlInsertOrderData = "INSERT INTO `tblorderdetails`(`OrderID`, `CustomerID`, `ServiceID`,`ServciePriceOnPurchaseTime`) VALUES ({$paramList['ORDERID']},{$_SESSION['UserID']}, {$_SESSION['SERVICEID']},'{$paramList['TXNAMOUNT']}')";
			$queryInsertOrderData = mysqli_query($dbConn, $sqlInsertOrderData) or die(mysqli_error($dbConn));
			if ($queryInsertOrderData) {
				$_SESSION['ORDERINSERTDONE'] = true;
			}
			$_SESSION['isREQPENDING'] = true;
			$sqlInsertPaymentData = "INSERT INTO `tblcustomerpaymentdetails`(`DiscountID`, `OrderID`, `TransactionID`, `PaymentMode`, `PayableAmount`, `PaymentDateTime`, `PaymentStatus`, `GatewayName`, `BankTransactionID`, `PaymentCurrency`, `BankName`) VALUES ('{$discountID}', {$paramList['ORDERID']}, {$paramList['TXNID']}, '{$paramList['PAYMENTMODE']}','{$paramList['TXNAMOUNT']}', '{$paramList['TXNDATE']}', '{$txnStatus}', '{$paramList['GATEWAYNAME']}',{$paramList['BANKTXNID']},'{$paramList['CURRENCY']}','{$paramList['BANKNAME']}')";
			$queryInsertPaymentData = mysqli_query($dbConn, $sqlInsertPaymentData) or die(mysqli_error($dbConn));
			if ($queryInsertPaymentData) {
				$_SESSION['PAYINSERTDONE'] = true;
			}
			if (
				isset($_SESSION['PAYINSERTDONE']) && $_SESSION['PAYINSERTDONE'] == true &&
				isset($_SESSION['ORDERINSERTDONE']) && $_SESSION['ORDERINSERTDONE'] == true
			) {
				unset($_SESSION['SERVICEID']);
				unset($_SESSION['PAYINSERTDONE']);
				unset($_SESSION['PAYINSERTDONE']);
				unset($_SESSION['ORDERINSERTDONE']);
				unset($_SESSION['ORDERINSERTDONE']);
			}
			header("Location:/FSMS/order/submit-requirement.php");
		} else {
			header("Location:/FSMS/order/submit-requirement.php");
		}
	} else {
		echo "<b>Transaction is fail</b>" . "<br/>";
	}
} else {
	header("Location:/FSMS/");
}
