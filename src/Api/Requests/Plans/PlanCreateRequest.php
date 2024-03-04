<?php

namespace Igorstefanovdeveloper\Nekki\Api\Requests\Plans;

use Igorstefanovdeveloper\Nekki\HandlersForTextProcessor\ImgTagRemover;
use Igorstefanovdeveloper\Nekki\HandlersForTextProcessor\ProfanityFilter;
use Igorstefanovdeveloper\Nekki\HandlersForTextProcessor\UrlReplacer;
use Igorstefanovdeveloper\Nekki\PlansStore;
use Igorstefanovdeveloper\Nekki\TextProcessor;

class PlanCreateRequest
{

    private PlansStore $store;

    public function __construct(PlansStore $store)
    {
        $this->store = $store;
    }

    public function savePlan(string $type, string $name, string $price, string $description, string $isActive): bool|string
    {
        //validation for name and description
        $textProcessor = new TextProcessor();

        $textProcessor->addHandler(new ProfanityFilter());
        $textProcessor->addHandler(new ImgTagRemover());
        $textProcessor->addHandler(new UrlReplacer());

        $name = $textProcessor->process($name);
        $description = $textProcessor->process($description);

        if ($this->store->savePlan($type, $name, $price, $description, $isActive)) {
            return $name;
        }

        return false;
    }

}
