<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\MainMenu\MainMenu;
use App\Model\Category\CategoryRepository;
use App\Model\Category\Category;
use Nette\Application\UI\Presenter;
use App\Model\BaseRepository;

class BasePresenter extends Presenter
{
    /** @var CategoryRepository */
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    public function createComponentMainMenu(): MainMenu
    {
        $categories = $this->categoryRepository->findBy([Category::COLUMN_PARENT => null]);
        $links = [];

        foreach ($categories as $category) {
            $links[] = [
                'url' => $category->getUrl(),
                'name' => $category->getName(),
            ];
        }

        return new MainMenu($links);
    }
}
