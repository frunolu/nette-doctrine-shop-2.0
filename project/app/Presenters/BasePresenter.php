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
        $links = [
            [
                'url' => 'pekarna-a-cukrarna',
                'name' => 'Pekárna a cukrárna'
            ],
            [
                'url' => 'maso-a-ryby',
                'name' => 'Maso a ryby'
            ]
        ];
        return new CategoriesMenu($links);
    }

}
