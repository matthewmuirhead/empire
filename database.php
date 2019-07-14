<?php
$server = '192.168.56.2';
$schema = 'empire';
$username = 'student';
$password = 'student';

$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password,
	[ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
