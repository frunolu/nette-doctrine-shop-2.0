<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\MainMenu\MainMenu;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{
    /**
     * @return MainMenu
     */
    public function createComponentMainMenu(): MainMenu
    {
        return new MainMenu();
    }

}
