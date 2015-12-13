<?php
/*
 * @category  Data Access Layer
 * @package   classes/databases
 * @file      database-connection.php
 * @data      01/10/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
*/
class Database{
		

	//Database details
	var $host = "localhost";
	var $username = "food_jackal";
	var $password = "Project2015";
	var $database = "Food_Jackal";
	var $conn;
	var $result;


	/*Open Connection to the database*/
	public function connectToDatabase()
	{
		$this->conn = new mysqli($this->host,$this->username,$this->password,$this->database);

		if($this->conn->connect_error){//Testing Connection
			die("Cannot connect to database. Ref: database-connect.php");
		}
	
	

	}//Close mysql_connect
	

	/*Select Data*/
	public function selectData($sql){

		if(empty($sql)){
			return false;
			die('SELECT Query Failed '.$this->conn->error);
		}
		$this->result = $this->conn->query($sql);

		return $this->result;//Return the dataset
	}
	
	
	/* Insert Data */
	public function insertData($sql){
		
		if($this->conn->query($sql) === FALSE){
			die('Insert Query Failed '.$this->conn->error);
		}else{
			return true;
			}

	}

	/* Update Database */
	public function updateDatabase($sql){
		if($this->conn->query($sql) === FALSE){
			echo $this->conn->error;
		}else{
			return true;
			}

	}

	public function getLastId(){
		$last_id = $this->conn->insert_id;
		return $last_id;
	}
	/* Delete Data */

	public function deleteData($sql){
		if($this->conn->query($sql) === FALSE){
			die('Delete Query Failed '.$this->conn->error);
		}
	}
	
	/*Close connection to database*/
	public function closeConnection()
	{
		$this->conn->close();
	}

}//Close Class



?>
