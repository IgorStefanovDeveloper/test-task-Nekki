<?php

use Igorstefanovdeveloper\Nekki\Api\Requests\Plans\PlanCreateRequest;
use Igorstefanovdeveloper\Nekki\DataProvider\MysqlProvider;
use Igorstefanovdeveloper\Nekki\Logger;
use Igorstefanovdeveloper\Nekki\Mailer;
use Igorstefanovdeveloper\Nekki\PlansStore;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";

// get env variables
$dotenv = new Dotenv();

$dotenv->load(__DIR__ . '/../.env');

$dataProvider = MysqlProvider::getInstance($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

$mailer = new Mailer();

$logger = new Logger($_ENV['LOG_FILE']);

if (isset($_REQUEST['type']) && isset($_REQUEST['name']) && isset($_REQUEST['price']) && isset($_REQUEST['description']) && isset($_REQUEST['isActive'])) {
    try {
        $store = new PlansStore($dataProvider);

        $requestObject = new PlanCreateRequest($store);

        $res = $requestObject->savePlan($_REQUEST['type'], $_REQUEST['name'], $_REQUEST['price'], $_REQUEST['description'], $_REQUEST['isActive']);

        if ($res !== false) {
            $subject = 'Новый план создан';
            $message = 'Был создан новый план: ' . $res . ".";

            $mailer->send($_ENV['ADMINISTRATOR_EMAIL'], $subject, $message);

            $logger->addToLog($message);

            echo json_encode($message);
        }
    } catch (Exception $e) {
        echo json_encode('Произошла ошибка: ' . $e->getMessage());

        $logger->addToLog('Произошла ошибка: ' . $e->getMessage());
        exit;
    }
}

