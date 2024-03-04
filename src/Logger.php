<?php

namespace Igorstefanovdeveloper\Nekki;

class Logger
{
    private string $logFile;

    public function __construct(string $logFile)
    {
        $this->logFile = $logFile;
    }

    /**
     * @param $message add message to log
     * @return void
     */
    public function addToLog($message): void
    {
        $logEntry = date('Y-m-d H:i:s') . ': ' . $message . PHP_EOL;
        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
}
