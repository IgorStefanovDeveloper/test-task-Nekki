<?php

use Igorstefanovdeveloper\Nekki\Api\Requests\Plans\PlanCreateRequest;
use Igorstefanovdeveloper\Nekki\DataProvider\MysqlProvider;
use Igorstefanovdeveloper\Nekki\Logger;
use Igorstefanovdeveloper\Nekki\Mailer;
use Igorstefanovdeveloper\Nekki\PlansStore;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";

const ROUTES = [
    '/api/v1/save'
];

// get env variables
$dotenv = new Dotenv();

$dotenv->load(__DIR__ . '/../.env');

$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];
$adminEmail = $_ENV['ADMINISTRATOR_EMAIL'];
$logFile = $_ENV['LOG_FILE'];

$dataProvider = MysqlProvider::getInstance($host, $username, $password, $database);
$mailer = new Mailer();
$logger = new Logger($logFile);


if (isset($_REQUEST['type']) && isset($_REQUEST['name']) && isset($_REQUEST['price']) && isset($_REQUEST['description']) && isset($_REQUEST['isActive'])) {
    $store = new PlansStore($dataProvider);

    $requestObject = new PlanCreateRequest($store);

    $res = $requestObject->savePlan($_REQUEST['type'], $_REQUEST['name'], $_REQUEST['price'], $_REQUEST['description'], $_REQUEST['isActive']);
    if ($res !== false) {
        $subject = 'Новый план создан';
        $message = 'Был создан новый план: ' . $res . ".";

        $mailer->send($adminEmail, $subject, $message);

        $logger->addToLog($message);
    }
}

