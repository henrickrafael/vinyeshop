<?php

	$host = 'localhost';
	$usr = 'root';
	$pwd = 'nirvana123';
	$pwd = '';
	$db = 'vinyeshop';
	$port = 3306;
	$socket = '/var/run/mysqld/mysqld.sock';

	#$con = mysqli_connect($host, $usr, $pwd, $db, $port, $socket);
	$con = mysqli_connect($host, $usr, $pwd, $db);
?>