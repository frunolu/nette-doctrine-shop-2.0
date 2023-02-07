<?php

namespace App\Components\MainMenu;

use Nette\Application\UI\Control;

class MainMenu extends Control
{
    /**
     * @var array
     */
    private array $links = [];

    public function __construct(array $links = [])
    {
        foreach ($links as $link) {
            $this->addLink ($link['url'], $link['name']);
        }

    }
    public function render():void
    {
        $this->getTemplate ()->setFile (__DIR__ . '/templates/MainMenu.latte');
        $this->getTemplate ()->links = $this->links;
        $this->getTemplate ()->render();
    }
    public function addLink($url, $name): void
    {
        $this->links[] = [
            'name' => $name,
            'url' => $url
        ];
    }

}
