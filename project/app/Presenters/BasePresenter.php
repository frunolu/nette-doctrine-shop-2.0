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
        $links = [
            [
                'url' => 'pekarna-cukrarna',
                'name' => 'Pekárna a cukrárna'
            ],
            [
                'url' => 'maso-a-ryby',
                'name' => 'Maso a ryby'
            ]
        ];
        return new MainMenu($links);
    }
}
