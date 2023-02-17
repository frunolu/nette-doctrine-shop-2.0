<?php

declare(strict_types=1);

namespace App\Components\MainMenu;

use Nette\Application\UI\Control;

class MainMenu extends Control
{
    /**
     * @var array
     */
    private array $links;

    /**
     * @param array<array{url:string, key:string}> $links
     */
    public function __construct(array $links)
    {
        foreach ($links as $link) {
            $this->addLink($link['url'], $link['name']);
        }
    }

    public function render(): void
    {
        $this->getTemplate()->setFile(__DIR__.'/templates/MainMenu.latte');
        $this->getTemplate()->links = $this->links;
        $this->getTemplate()->render();
    }

    public function addLink(string $url, string $name): void
    {
        $this->links[] = [
            'url' => $url,
            'name' => $name,

        ];
    }

}
