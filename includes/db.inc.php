<?php
  
  // define poperties 
  $db_host = "localhost";
  $db_user = "root";
  $db_pass = "";
  $db_name = "ideas";


  //database connection mysqli
  $conn = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");


  //PDO cennection
  $DB_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);

  
  //database connection with class
  class Database
  {
    public $conn;
    public function __construct()
    {
      $this->conn = mysqli_connect('localhost', 'root', '', 'ideas');
    }
  }

?>