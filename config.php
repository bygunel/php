<?php
ob_start();
session_start();

ini_set('error_reporting', E_ALL);

date_default_timezone_set('Europe/istanbul');
setlocale(LC_ALL, 'tr_TR.UTF-8', 'tr_TR', 'tr', 'turkish');

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
	exit(' Erişim Engellendi.');
};

$config = [
	'host'      => 'localhost',
	'driver'    => 'mysql',
	'database'  => 'realist_portal',
	'port'      => '3306',
	'username'  => 'realist_portal',
	'password'  => 'ra9Y03ZUy',
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

$ip	=	$_SERVER["REMOTE_ADDR"];
