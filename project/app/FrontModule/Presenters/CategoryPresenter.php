<?php
declare(strict_types=1);

namespace App\FrontModule\Presenters;

use App\Model\Category\Category;
use App\Model\Category\CategoryNotFoundException;
use App\Model\Category\CategoryRepository;
use App\Presenters\BasePresenter;
use Nette\Application\BadRequestException;


final class CategoryPresenter extends BasePresenter
{

    private CategoryRepository $categoryRepository;

    private ?Category $category = null;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param string $slug
     * @return void
     * @throws BadRequestException
     */
    public function actionDefault(string $slug): void
    {
        try {
            $this->category = $this->categoryRepository->getByUrl($slug);
        } catch (CategoryNotFoundException $e) {
            $this->error();
        }
    }

    public function renderDefault(): void
    {
        $this->template->setParameters([
            'categoryId' => $this->category->getId(),
            'categoryName' => $this->category->getName(),
            'products' => $this->category->getProducts(),
        ]);
    }
}

