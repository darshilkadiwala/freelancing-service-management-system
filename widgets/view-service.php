<?php
$sqlService = "SELECT `tblservicedetail`.*, `tbluserpersonaldetails`.`Username` AS `Username`,`tbluserpersonaldetails`.`ProfilePicture` AS `ProfilePicture` FROM `tblservicedetail` LEFT JOIN `tbluserpersonaldetails` ON `tblservicedetail`.`FreelancerID` = `tbluserpersonaldetails`.`UserID` ORDER BY RAND()";
$queryService = mysqli_query($dbConn, $sqlService);
while ($row = mysqli_fetch_array($queryService)) {
?>
	<div class="mycard">
		<div class="mycard-service-img">
			<img src="data:image;base64,<?php echo base64_encode($row['ServiceImage']); ?>" width="300px" />
		</div>
		<div class="mycard-text">
			<div class="mycard-title"><a href="./view-service.php"><?php echo $row['ServiceTitle']; ?></a> </div>
			<div class="mycard-short-desc"><?php echo $row['ShortDescription']; ?></div>
		</div>
		
		<div class="mycard-user-info">
			<div class="username"><?php echo $row['Username']; ?></div>
			<div class="user-profile">
				<img src="data:image/jpeg;base64,<?php echo base64_encode($row['ProfilePicture']); ?>" height='200px' />
			</div>
		</div>
	</div>
<?php
}
?>