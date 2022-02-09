<?php
session_start();
require_once '../php/config.php';
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
	header("location: /FSMS/Login.php");
}
?>
<?php require_once 'header.php'; ?>
<div class="chat-wrapper">
	<section class="users">
		<header>
			<div class="content">
				<?php
				$sql = mysqli_query($dbConn, "SELECT `tbluserpersonaldetails`.`ProfilePicture`, `tbluserpersonaldetails`.`FirstName`, `tbluserpersonaldetails`.`LastName`, `tbluserpersonaldetails`.`UserStatus`
				FROM `tbluserpersonaldetails` WHERE `tbluserpersonaldetails`.`UserID` = {$_SESSION['UserID']}");
				if (mysqli_num_rows($sql) > 0) {
					$row = mysqli_fetch_assoc($sql);
				}
				?>
				<img src="data:image;base64,<?php echo base64_encode($row['ProfilePicture']) ?>" width="50px" alt="Profile">
				<div class="details">
					<span><?php echo $row['FirstName'] . " " . $row['LastName'] ?></span>
					<p><?php echo $row['UserStatus'] == 1 ? "Online" : "Offline"; ?></p>
				</div>
			</div>
			<button class="logout" id="btn-logout">Logout</button>
		</header>
		<div class="search">
			<span class="text">Select an user to start chat</span>
			<input type="text" placeholder="Enter name to search...">
			<button><i class="fas fa-search"></i></button>
		</div>
		<div class="users-list">

		</div>
	</section>
</div>
<script src="../assets/js/chat.js"></script>
<script src="../assets/js/scroll.js"></script>
<script src="../assets/js/main.js"></script>
</body>

</html>