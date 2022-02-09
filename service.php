<?php
session_start();
if (!(isset($_GET['service']) && !empty($_GET['service']))) { ?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Chats | FSMS</title>
		<?php
		require_once "./widgets/head-link-with-profile.php";
		?>
		<link href="/FSMS/assets/css/under-construction.css" rel="stylesheet" />
		<!-- <link href="//fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
		<link href="//fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"> -->

	</head>

	<body>
		<?php
		require_once './widgets/header.php';
		?>
		<div class="main-wrapper">
			<div class="main-content bg-color-12192C shadow-lg" id="main-content">
				<section class="w3l-coming-soon-page">
					<div class="coming-page-infohny">
						<div class="wrapper">
							<div class="coming-block">
								<h2>Page not found</h2>
								<h1>404</h1>
								<!-- <p class="parahny">This page is currently under maintenance. We Should be back shortly. Thank you for your patience.</p> -->
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<?php
		// require_once "../widgets/footer.php";
		// require_once "../../Footer1.php";
		?>
		<script src="/FSMS/assets/js/main.js"></script>
		<script src="/FSMS/assets/js/scroll.js"></script>
	</body>

	</html>
<?php
} else {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php
		require_once "./widgets/head-link.php";
		?>
		<link rel="stylesheet" type="text/css" href="/FSMS/assets/css/card.css">
		<link rel="stylesheet" type="text/css" href="/FSMS/assets/css/service-details.css">
		<link rel="stylesheet" type="text/css" href="/FSMS/assets/css/table.css">
		<link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/main.css">
	</head>

	<body>
		<?php
		require_once './widgets/header.php';
		require_once './php/functions.php';
		?>
		<div class="main-wrapper rd-10 ">
			<div class="main-content shadow" id="main-content">
				<?php viewServiceDetails($_GET['service']); ?>
			</div>
		</div>
		<?php
		require_once './widgets/footer.php';
		?>
		<script src="/FSMS/assets/js/main.js"></script>
		<script src="/FSMS/assets/js/scroll.js"></script>
	</body>

	</html>
<?php } ?>