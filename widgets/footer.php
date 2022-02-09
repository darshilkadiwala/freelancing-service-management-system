<footer class="site-footer">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-xs-6 col-md-3">
				<?php
				$servername = "localhost";
				$dBUsername = "root";
				$dBPassword = "";
				$dBName = "dbfsms";
				$dbConn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName) or
					die("Conection Failed... Internal server error...!! Please try later..");
				$sqlListCategory = "SELECT `ServiceCategoryID`, `ServiceCategoryName` FROM `tblservicecategories`";
				$queryListCategory = mysqli_query($dbConn, $sqlListCategory);
				if ($queryListCategory && mysqli_num_rows($queryListCategory)) { ?>
					<h6>Categories</h6>
					<ul class="footer-links">
						<?php
						while ($row = mysqli_fetch_assoc($queryListCategory)) {
							echo "<li><a href='/FSMS/category.php?c='" . $row['ServiceCategoryID'] . ">" . $row['ServiceCategoryName'] . "</a></li>";
						}
						?>
					</ul>
				<?php
				}
				?>
			</div>

			<div class="col-xs-6 col-md-3">
				<h6>Quick Links</h6>
				<ul class="footer-links">
					<!-- <li><a href="#">About Us</a></li> -->
					<li><a href="#">Contact Us</a></li>
					<!-- <li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Sitemap</a></li> -->
				</ul>
			</div>

			<div class="col-xs-6 col-md-3">
				<h6>Contact Us</h6>
				<ul class="info">
					<li>
						<!-- <span><img src="/FSMS/assets/icon/images/location.png"></span> -->
						<span><i class="fa fa-map-marker-alt"></i></span>
						<span>A-4/F-3 Hirachand Nagar,<br>
							Station Road,<br>
							Bardoli-394601 <br></span>
					</li>
					<li>
						<!-- <span><img src="/FSMS/assets/icon/images/mail.png"></span> -->
						<span><i class="fa fa-envelope"></i></span>
						<span>admin@FSMS.com</span>
					</li>
					<li>
						<!-- <span><img src="/FSMS/assets/icon/images/call.png"></span> -->
						<span><i class="fa fa-phone-alt"></i></span>
						<span>+91 9825226880</span>
					</li>
				</ul>
			</div>

			<div class="col-sm-6 col-md-3">
				<h6>Follow us</h6>
				<p>Follow us on </p>
				<ul class="social-icons text-left">
					<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
					<li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
				</ul>
			</div>
		</div>
		<hr>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-6 col-xs-12">
				<p class="copyright-text"> All Rights Reserved</p>
			</div>

			<div class="col-md-4 col-sm-6 col-xs-12">
				<ul class="social-icons">
					<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
					<li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>