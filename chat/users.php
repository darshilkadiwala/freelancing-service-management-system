<?php
session_start();
require_once "../php/config.php";
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
	header("Location: /FSMS/Login.php");
} else {
?>
	<?php require_once "header.php"; ?>
	<div class="chat-wrapper">
		<section class="chat-area">
			<header>
				<?php
				$userName = mysqli_real_escape_string($dbConn, $_GET['rname']);
				$sql = mysqli_query($dbConn, "SELECT `tbluserpersonaldetails`.`UserID`, 
				`tbluserpersonaldetails`.`ProfilePicture`, `tbluserpersonaldetails`.`FirstName`, 
				`tbluserpersonaldetails`.`LastName`, `tbluserpersonaldetails`.`UserStatus`
				FROM `tbluserpersonaldetails` WHERE `tbluserpersonaldetails`.`Username` = '{$userName}'");
				if (mysqli_num_rows($sql) > 0) {
					$row = mysqli_fetch_assoc($sql);
					// print_r($row);
				} else {
					echo "<script>window.location.href='./';</script>";
				}
				?>
				<a href="./" class="back-icon"><i class="fas fa-arrow-left"></i></a>
				<img src="data:image;base64,<?php echo base64_encode($row['ProfilePicture']) ?>" width="50px" alt="Profile">
				<div class="details">
					<span><?php echo $row['FirstName'] . " " . $row['LastName'] ?></span>
					<p><?php echo $row['UserStatus'] == 1 ? "Online" : "Offline"; ?></p>
				</div>
			</header>
			<div class="chat-box">
			</div>
			<form action="#" class="typing-area">
				<input type="hidden" class="incoming_id" name="incoming_id" value="<?php echo $row['UserID']; ?>" />
				<input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off" />
				<button><i class="fab fa-telegram-plane"></i></button>
			</form>
		</section>
	</div>
	</div>
	</div>

	<script src="/FSMS/assets/js/users.js"></script>
	</body>

	</html>
<?php } ?>