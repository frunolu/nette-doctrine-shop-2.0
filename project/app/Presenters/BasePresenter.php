<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\CategoriesMenu\CategoriesMenu;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{
    /**
     * @return CategoriesMenu
     */
    public function createComponentCategoriesMenu(): CategoriesMenu
    {
        return new CategoriesMenu();
    }

}
