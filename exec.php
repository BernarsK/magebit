<?php

include_once 'db.php';
include_once 'email.class.php';

// creating new database object
$db = new Database();

$email_get = $_POST['email'];

$date_created = date("Y.d.m");  

$email = new Email(NULL,$email_get, $date_created);

$db->addNewEmail($email);

// closing the database connection after using it
$db->db_disconnect();
// forwards user to success page
header('Location: success.html');
?>