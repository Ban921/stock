<?php
require 'vendor/autoload.php';
require 'config.php';
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Simplon\Mysql\Mysql;
use Simplon\Mysql\PDOConnector;

$pdoConnector = new PDOConnector($config['server'], $config['username'], $config['password'], $config['database']);
$dbh = new Mysql($pdoConnector->connect());

exit;

$client = new GuzzleHttp\Client(['base_uri' => 'http://www.twse.com.tw']);
$response = $client->request('GET', '/exchangeReport/MI_INDEX?response=json&date=20180503&type=ALL&_='.round(microtime(true) * 1000));
$text = json_decode($response->getBody()->getContents());

foreach($text->data5 as $k => $v){
    print_r($v);
    echo $v[0];
}
