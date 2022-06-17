<?php
require 'vendor/autoload.php';

use GuzzleHttp\Exception\GuzzleException;
use Simplon\Mysql\Mysql;
use Simplon\Mysql\PDOConnector;

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

$pdoConnector = new PDOConnector($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
try {
	$dbh = new Mysql($pdoConnector->connect());
} catch (Exception $e) {
	echo $e->getMessage();
}

try {
	$client = new GuzzleHttp\Client(['base_uri' => 'https://www.twse.com.tw']);
	$response = $client->request('GET', '/exchangeReport/MI_INDEX?response=json&date=20180503&type=ALL&_=' . round(microtime(true) * 1000));

	$text = json_decode($response->getBody()->getContents());
	foreach($text->data5 as $k => $v){
		print_r($v);
	}
} catch (GuzzleException $e) {
	echo $e->getMessage();
}


