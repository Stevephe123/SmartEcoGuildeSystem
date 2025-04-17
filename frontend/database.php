	<?php
	error_reporting(0);
	$Username = "root";
	$Password = "";
	$LocalHost = "localhost";
	$dbName = "dbsegs";

	/*Set your localhost username and password at above*/

	$Table = array("CREATE TABLE IF NOT EXISTS userlist(Id int(11) PRIMARY KEY AUTO_INCREMENT,
														  Username VARCHAR(20),
														  Email VARCHAR(40),
														  Password CHAR(64),
														  UserRole VARCHAR(30),
														  session_id VARCHAR(64),
														  time int(11),
														  Status VARCHAR(20))");

	//create datebase connection
	$Con = new mysqli($LocalHost, $Username, $Password);
	
	if($Con->errno)
	{
		echo "Connect Fail".$Con->connect_error; //Check Error
		exit();
	}
	else
	{
		//Create database
		$Query = "CREATE DATABASE IF NOT EXISTS ".$dbName;
		$Con->query($Query); //Find this query and connect, if doesnt have create;
		
        
		//Choose Database
		$Con->select_db($dbName);
		
		for($i = 0; $i<count($Table); $i++)
		{
			 $Table[$i]."<br>";
			 $Con->query($Table[$i]); //if still error cannot create table check variable
		}
       /* $AddSysUser = "INSERT INTO tbllogin(Ic, Username, Password, UserRole, Status) VALUES('1',
                'ADMIN',
                '".md5('123')."', 'ADMINISTRATOR', 'ACTIVE')"; $AddResult = $Con->query($AddSysUser);*/
		
	}
?>