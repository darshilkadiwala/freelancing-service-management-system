<?php
require_once '../config.php';
// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
	// name of the uploaded file
	$filename = $_FILES['file']['name'];

	// destination of the file on the server
	$destination = '../user-content/orders-delivery-file/' . $filename;

	// get the file extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);

	// the physical file on a temporary uploads directory on the server
	$file = $_FILES['file']['tmp_name'];
	$size = $_FILES['file']['size'];

	if (!in_array($extension, ['zip'])) {
		echo "You file extension must be .zip, .pdf or .docx";
	} elseif ($_FILES['file']['size'] > 4000000000) { // file shouldn't be larger than 1Megabyte
		echo "File too large!";
	} else {
		// move the uploaded (temporary) file to the specified destination
		if (move_uploaded_file($file, $destination)) {
			$sql = "INSERT INTO files (name, size, downloads) VALUES ('$destination', $size, 0)";
			if (mysqli_query($dbConn, $sql)) {
				echo "File uploaded successfully";
			}
		} else {
			echo "Failed to upload file.";
		}
	}
}
