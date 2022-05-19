<?php
ob_start();
$config = [
	'host'      => 'localhost',
	'driver'    => 'mysql',
	'database'  => 'doviz',
	'port'      => '3306',
	'username'  => 'root',
	'password'  => '',
	'charset'   => 'utf8',
	'collation' => 'utf8_turkish_ci',
	'prefix'    => ''
];

$host 		= $config['host'];
$database 	= $config['database'];
$port 		= $config['port'];
$username 	= $config['username'];
$password 	= $config['password'];


try {
	$db = new PDO("mysql:host=$host;port=$port;dbname=$database;charset=utf8", $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
} catch (PDOException $e) {
	echo "Bağlantı hatası : " . $e->getMessage();
}
