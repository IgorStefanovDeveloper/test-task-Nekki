<?php

namespace Igorstefanovdeveloper\Nekki\DataProvider;

interface DataProviderInterface {
    public function executeSql(string $sql): bool;
}
