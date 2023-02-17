<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\MainMenu\MainMenu;
use App\Model\Category\CategoryRepository;
use App\Model\Category\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Setup;
use Nette\Application\UI\Presenter;
use Nette\Database\Context;
use Tracy\Debugger;
use App\Model\BaseRepository;

class BasePresenter extends Presenter
{
    /** @var CategoryRepository @inject */
    public CategoryRepository $categoryRepository;
    /** @var BaseRepository @inject */
    public BaseRepository $baseRepository;

    public function __construct(BaseRepository $baseRepository, CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->baseRepository = $baseRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function createComponentMainMenu(): MainMenu
    {
        $em = $this->baseRepository->getEntityManager();
        $category = $em->getRepository(Category::class);

        $links = [];
        $categories = $category->findBy(    // $category->findAll();
            [
                'parent' => null,
            ],
        );
        foreach ($categories as $category) {
            $links[] = [
                'url' => $category->getUrl(),
                'name' => $category->getName(),
            ];
        }

        Debugger::barDump($links);

        return new MainMenu($links);
    }
}

