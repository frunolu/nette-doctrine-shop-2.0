<?php
declare(strict_types=1);

namespace App\FrontModule\Presenters;

use App\Model\Product\Product;
use App\Model\Product\ProductNotFoundException;
use App\Model\Product\ProductRepository;
use App\Presenters\BasePresenter;
use Nette\Application\BadRequestException;

final class ProductPresenter extends BasePresenter
{

    private ProductRepository $productRepository;

    private ?Product $product = null;

    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct();

        $this->productRepository = $productRepository;
    }

    /**
     * @param string $slug
     * @return void
     * @throws BadRequestException
     */
    public function actionDefault(string $slug): void
    {
        try {
            $this->product = $this->productRepository->getByUrl($slug);
        } catch (ProductNotFoundException $e) {
            $this->error();
        }
    }

    public function renderDefault(): void
    {
        $this->template->setParameters([
            'productId' => $this->product->getId(),
            'productName' => $this->product->getName(),
            'productShortDescription' => $this->product->getShortDescription(),
        ]);
    }

    public function actionAddToCart($id)
    {
        $this->cartManager->addItem($id);

        $this->flashMessage('Product has been added to cart.');
        $this->redirect('this');
    }

}
