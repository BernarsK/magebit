<?php
	include_once 'email.class.php';
	include_once 'db.php';

	$db = new Database();
	//getting checkbox ID which value is equal to database ID entry
	$name = $_GET['checkArr'];
	foreach ($name as $checkArr){ 
		$db->deleteEntry($checkArr);
	}
	header('Location: admin.php');
?>