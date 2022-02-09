<?php
session_start();
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
	header("Location: /FSMS/");
} else {
	require_once '../php/config.php';
	require_once '../php/constants.php';
	require_once '../php/functions.php';
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Update Profile | FSMS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<?php
		require_once "../widgets/head-link-with-profile.php";
		?>

	</head>

	<body class="bg-color-900c3f">
		<?php
		require_once '../widgets/header.php';
		?>
		<div class="main-wrapper">
			<?php
			require_once "../widgets/sidebar.php";
			?>
			<div class="main-content bg-color-F5A623" id="main-content">
				<div class="row rd-10 justify-content-md-center shadow-lg px-5 py-5 bg-color-12192C">
					<div class="align-items-center">
						<h1 id="lblProfile" class="h1 text-white ml-3 font-weight-bold">Profile</h1>
						<hr class="bg-light mx-3" />
						<div class="row justify-content-center">
							<div class="col-xl-4 order-xl-2 my-2">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<h5 class="text-muted ml-2 m-0" id="lblProfileImage">Profile image</h5>
											<!-- <button id="btnEditFrmUserInfo" class="d-flex" style="outline: none; border:none; background: transparent;">
														<i class='bx bxs-edit btn-icon'></i>
														<i class='bx bx-x btn-icon'></i>
													</button> -->
										</div>
									</div>
									<div class="card-body">
										<div class="row justify-content-center">
											<div class="col-lg-6 col-sm-4 order-lg-2 p-2">
												<div class="card-img-top">
													<img id="imgProfilePic" src="" width="70%" class="mx-auto d-block img-thumbnail rounded-circle" />
												</div>
											</div>
										</div>

										<hr class="bg-color-12192C mx-4" />
										<div class="text-center">
											<h5 class="h3" id="users-name"></h5>
											<div class="h5 font-weight-300" id="username">

											</div>
											<div class="h6 font-weight-300" id="city-state">
												<i class="bx bxs-map-pin mr-2"></i>
											</div>
										</div>
										<?php if ($_SESSION['RoleID'] == 2) { ?>
											<hr class="bg-color-12192C mx-4" />
											<div class="row">
												<div class="col">
													<div class="card-profile-stats d-flex justify-content-center">
														<div class="p-0 ">
															<span class="heading" id="totalService">3</span>
															<span class="description">Total Service</span>
														</div>
														<div class="p-0 ">
															<span class="heading">89</span>
															<span class="description">Pending Orders</span>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>

								</div>
							</div>
							<div class="col-xl-8 order-xl-1 my-2">
								<div class="card">
									<div class="card-body">
										<div class="popup-msg" id="popup-msg" style="display: none;"></div>
										<div class="card-header">
											<div class="row">
												<h5 class="text-muted mx-2 border-0" id="lblUserInfo">User information</h5>
												<button id="btnEditFrmUserInfo" class="d-flex" style="outline: none; border:none; background: transparent;">
													<i class='bx bxs-edit btn-icon'></i>
													<i class='bx bx-x btn-icon'></i>
												</button>
											</div>
										</div>
										<div class="pl-lg-4 mr-4 mt-4">
											<form id="frmUserInfo" method="POST" autocomplete="off">
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label id="lblFname" for="txtFname" class="form-control-label">First name :</label>
															<input type="text" id="txtFname" name="txtFname" class="form-control" tooltip="First name is required" placeholder="First name" required />
															<span class="error-msg" id="firstnameErr"></span>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="txtLname" id="lblLname" class="form-control-label">Last name :</label>
															<input type="text" id="txtLname" name="txtLname" class="form-control" placeholder="Last name" required />
															<span class="error-msg" id="lastnameErr"></span>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label id="lblDob" for="txtDob" class="form-control-label">Date of Birth :</label>
															<input type="date" id="txtDob" name="txtDob" class="form-control" required />
															<span class="error-msg" id="dateofbirthErr"></span>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<div class="form-row">
																<label id="lblGender" for="rbtnlistGender" class="form-control-label">Gender : </label>
															</div>
															<div class="form-row">
																<div id="rbtnlistGender">
																	<input type="radio" id="rbtnlistGenderM" name="rbtnlistGender" class="form-check-inline ml-3" value="Male" required />
																	<label for="rbtnlistGenderM" class="form-check-label">Male</label>
																	<input type="radio" id="rbtnlistGenderF" name="rbtnlistGender" class="form-check-inline ml-3" value="Female" required />
																	<label for="rbtnlistGenderF" class="form-check-label">Female</label>
																</div>
																<span class="error-msg" id="genderErr"></span>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="error-msg" id="error-msg-userinfo"></div>
													<div class="col-12 text-right">
														<div class="loadingButton">
															<button id="btnSave" type="submit" class="btn Btn-large" style="display: none;"><i class='bx bxs-check-circle btn-icon'></i>Save</button>
														</div>
													</div>
												</div>
											</form>
										</div>
										<hr class="my-4" />
										<div class="card-header">
											<div class="row">
												<h5 class="text-muted mx-2 border-0" id="lblContactInfo">Contact information</h5>
												<button id="btnEditFrmContactInfo" class="d-flex" style="outline: none; border:none; background: transparent;">
													<i class='bx bxs-edit btn-icon'></i>
													<i class='bx bx-x btn-icon'></i>
												</button>
											</div>
										</div>
										<div class="pl-lg-4 mr-4 mt-4">
											<form id="frmContactInfo" method="POST" autocomplete="off">
												<div class="row">
													<div class="col-md-auto">
														<div class="form-group">
															<label id="lblContacNo" for="drpdlistCountryCode" class="form-control-label">Contact No : </label>
															<div class="form-row">
																<div class="col-3">
																	<select id="drpdlistCountryCode" name="drpdlistCountryCode" class="rd-10 px-1 py-2 form-control" disabled>
																		<option value="none" disabled>-- Select Country Code --</option>
																		<option value="+91">+91</option>
																	</select>
																</div>
																<div class="col-auto">
																	<input type="text" id="txtContactNo" name="txtContactNo" class="form-control" placeholder="Contact No" MaxLength="10" pattern="[6-9]{1}[0-9]{9}" required />
																</div>
															</div>
															<span class="error-msg wrap-word" id="contactnumErr"></span>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label id="lblAddress" class="form-control-label">Address :</label>
															<textarea id="txtAddress" name="txtAddress" class="form-control" placeholder="Address" type="text" required></textarea>
															<span class="error-msg" id="addressErr"></span>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label id="lblCity" for="drpdlistCity" class="form-control-label">City :</label>
															<select id="drpdlistCity" name="drpdlistCity" class="form-control" required>
																<option value="" disabled selected>-- Select State first --</option>
															</select>
															<span class="error-msg" id="cityErr"></span>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label id="lblState" for="drpdlistState" class="form-control-label">State :</label>
															<select id="drpdlistState" name="drpdlistState" class="form-control" Width="10px" required>
																<option value="" disabled selected>-- Select State --</option>
															</select>
															<span class="error-msg" id="stateErr"></span>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label id="lblCountry" for="drpdlistCountry" class="form-control-label">Country :</label>
															<select id="drpdlistCountry" name="drpdlistCountry" class="form-control" disabled required>
																<option value="none" disabled>-- Select Country --</option>
																<option value="India">India</option>
															</select>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label id="lblPincode" for="txtPincode" class="form-control-label">Pincode :</label>
															<input id="txtPincode" name="txtPincode" class="form-control" placeholder="Pincode" MaxLength="6" pattern="\d{6}" required />
															<span class="error-msg" id="pincodeErr"></span>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-12 text-right">
														<div class="loadingButton">
															<button id="btnSave" type="submit" class="btn Btn-large" style="display: none;"><i class='bx bxs-check-circle btn-icon'></i>Save</button>
														</div>
													</div>
												</div>
											</form>
										</div>
										<!--<hr class="my-4" />
															 <h5 class="text-muted ml-2 mb-4 card-header border-0">About me</h5>
															<div class="pl-lg-4 mr-4">
																<div class="form-group">
																	<label class="form-control-label">About Me</label>
																	<textarea rows="4" class="form-control" placeholder="A few words about you ...">A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</textarea>
																</div>
															</div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		require_once '../widgets/footer.php';
		?>
		<script src="/FSMS/assets/js/scroll.js"></script>
		<script src="/FSMS/assets/js/main.js"></script>
		<script src="/FSMS/assets/js/load-state-city.js"></script>
		<script src="/FSMS/assets/js/dashboard/profile.js"></script>
	</body>

	</html>
<?php
}
?>