<?php

declare(strict_types=1);

namespace App\Components\CategoriesMenu;

use Nette\Application\UI\Control;

class CategoriesMenu extends Control
{
    public function render():void
    {
        $this->getTemplate()->setFile (__DIR__ . '/templates/CategoriesMenu.latte');
        $this->getTemplate()->render();
    }
}
