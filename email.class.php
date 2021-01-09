<?php

class Email{

  private $dbid;
  private $email;
  private $date;

  //constructing each email object
  function __construct($dbid, $email, $date){
    $this->dbid = $dbid;
    $this->email = $email;
    $this->date = $date;
  }

  function getEmail(){
    return $this->email;
  }
  
  function getDBID(){
    return $this->dbid;
  }

  function getDate(){
    return $this->date;
  }
}
?>