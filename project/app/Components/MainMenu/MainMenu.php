<?php

namespace App\Components\MainMenu;

use Nette\Application\UI\Control;

class MainMenu extends Control
{
    public function render():void
    {
        $this->template->setFile (__DIR__ . '/templates/MainMenu.latte');
        $this->template->render();
    }
}
