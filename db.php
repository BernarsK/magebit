<?php

include_once 'email.class.php';

class Database {

	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $conn;

	// create database connection when database object is created
	function __construct(){
		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "shop";

		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
	}

	// a function that queries all the table contents
	function find_all(){
		$sql = "SELECT * FROM emails";
		return $this->conn->query($sql);
	}

	function deleteEntry($dbid){
		$sql = "DELETE FROM emails WHERE id=$dbid";
		if ($this->conn->query($sql) === TRUE) {
		echo "Email was deleted successfuly!";
		} else {
			echo "Error: " . $sql . "<br>" . $this->conn->error;
		}
	}

	function addNewEmail($email){
		// creating the sql query
		$sql = "INSERT INTO emails (email,date_created) VALUES ('" . $email->getEmail() . "','" . $email->getDate() . "')";
		if ($this->conn->query($sql) === TRUE) {
	    echo "Record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $this->conn->error;
		}
	}

	function showEmails(){
		$emails = array();
		$result = $this->find_all();
		while($row = $result->fetch_assoc()){
			$email = new Email($row['id'], $row['email'], $row['date_created']);
			$emails[] = $email;
		}
		// sort emails by date by default
		$sort = array();
		foreach ($emails as $i => $obj) {
			$col = $obj->getDate();
		  	$sort[$i] = $col;
		}
		$sorted_db = array_multisort($sort, SORT_ASC, $emails);
		
		foreach ($emails as $i => $obj){
			$i = $obj->getEmail();
			$dbid = $obj->getDBID();
			// dabut @ domain
			$email_split = explode("@", $i);
			$domain = $email_split[1];
			$emailVar = $domain . "-element";
			echo '<tr class="email ' . $emailVar .'" id="'.$emailVar .'"><td>'. $obj->getDBID() .'</td>';
			echo '<td>'.$i .'</td>';
			echo '<td>'. $obj->getDate() .'</td>';
			echo '<td><input type="checkbox" id="'.$dbid.'" name="checkArr[]" value="'.$dbid.'"></td></tr>';
		}

		//echo '<pre>'; print_r($emails); echo '</pre>';
	}

	function getButtons(){
		$result = $this->find_all();
		while($row = $result->fetch_assoc()){
			$email = $row['email'];
			$email_split = explode("@", $email);
			$domain = $email_split[1];
			$buttons[] = $domain;
		}
		$unique = array_unique($buttons);
		foreach($unique as $i){
			echo '<input type="button" name="' .  $i. '" value="'. $i.'" id="' .$i. '" onclick="reloadEmails(this.id);">';
		}
		return $unique;
	}

	function getButtonNames(){
		$result = $this->find_all();
		while($row = $result->fetch_assoc()){
			$email = $row['email'];
			$email_split = explode("@", $email);
			$domain = $email_split[1];
			$buttons[] = $domain;
		}
		$unique = array_unique($buttons);
		return $unique;
	}

	// function to close the database connection but only if the connection is active to prevent errors
	function db_disconnect(){
		if(isset($this->conn)){
			$this->conn->close();
		}
	}
}



?>
