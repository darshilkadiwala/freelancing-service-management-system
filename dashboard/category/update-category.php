<?php
session_start();
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
	header("Location: /FSMS/Login.php");
} else { ?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Profile | FSMS</title>
		<?php
		require_once "../../widgets/head-link-with-profile.php";
		?>
	</head>

	<body>
		<?php
		require_once '../../widgets/header.php';
		?>
		<div class="main-wrapper">
			<?php
			require_once "../../widgets/sidebar.php";
			?>
			<div class="main-content" id="main-content" style="background:#F5A623;">
				<div id="admin-content">
					<div class="container">
						<div class="row">

							<div class="col-md-offset-3 col-md-8">
								<?php
								require_once '../../php/config.php';
								require_once '../../php/functions.php';
								if (isset($_GET['cid']) && (!empty($_GET['cid']))) {
									$cid = test_input($_GET['cid']);

									$selectquery = "SELECT * FROM tblservicecategories WHERE `ServiceCategoryID`={$cid}";
									$query = mysqli_query($dbConn, $selectquery);
									if (mysqli_num_rows($query) > 0) { ?>
										<div class="col-md-12">
											<h1><b>Update Category :
													<?php
													while ($row = mysqli_fetch_array($query)) { ?>
														<?php echo $row['ServiceCategoryName'] ?></b></h1>
											<h3 id="error-msg"></h3>
											<hr>
											<div class="col-md-9">
												<form action="#" id="frmUpdateCatagory" autocomplete="off">
													<div class="form-group">
														<label>Category Name</label>
														<input type="text" name="categoryName" class="form-control" value="<?php echo $row['ServiceCategoryName'] ?>" placeholder="Category Name" required><br />
														<label>Category Short Description</label>
														<input type="text" name="categoryDesc" class="form-control" value="<?php echo $row['ShortDescription'] ?>" maxlength="100" placeholder="Category ShortDescription" required>
														<input type="hidden" name="categoryId" value="<?php echo $row['ServiceCategoryID'] ?>" required>
														<div class="mt-3">
															<input type="submit" name="btnUpdate" id="btnUpdate" class="btn Btn1 mr-3 loadingButton" value="Update" required />
															<a href="./index.php" class="btn Btn">Back</a>
														</div>
													</div>
												</form>
											</div>
										</div>
									<?php
													}
												} else {
									?>
									<label>No category found for Category id : </label>
									<?php
													echo $cid;
									?>
								<?php
												} ?>



							<?php
								} else {
							?>
								<label>No category found for Category id : </label>
								<?php

								?>
								<br /><a href="./index.php" class="btn Btn">Back</a>
							<?php
								}
							?>
							<br />

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		require_once '../../widgets/footer.php';
		?>
		<script src="/FSMS/assets/js/main.js"></script>
		<script src="/FSMS/assets/js/scroll.js"></script>
		<script src="/FSMS/assets/js/update-category.js"></script>
	</body>

	</html>
<?php } ?>