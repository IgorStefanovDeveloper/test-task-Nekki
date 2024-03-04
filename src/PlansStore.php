<?php

namespace Igorstefanovdeveloper\Nekki;

use Igorstefanovdeveloper\Nekki\DataProvider\DataProviderInterface;

class PlansStore
{
    private DataProviderInterface $dataProvider;

    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Add
     * @param string $type_id
     * @param string $name
     * @param string $price
     * @param string $description
     * @param string $isActive
     * @return bool
     */
    public function savePlan(string $type_id, string $name, string $price, string $description, string $isActive): bool
    {
        $query = 'INSERT INTO plans (type_id, name, price, description, is_active) VALUES (' . $type_id . ', ' . $name . ', ' . $price . ', ' . $description . ', ' . $isActive . ')';

        if ($this->dataProvider->executeSql($query)) {
            return $name;
        }

        return false;
    }
}


