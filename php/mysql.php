<?php
	session_start();
	error_reporting(0);
	$mysql = new mysqli('localhost','root','123','db_lks-coba');
	if($mysql->connect_errno)
	{
		echo 'MySQL Error ['.$mysql->connect_errno.']: '.$mysql->error;
	}
?>