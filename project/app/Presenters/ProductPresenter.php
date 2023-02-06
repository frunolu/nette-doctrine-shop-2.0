<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Model\Product\Product;
use App\Model\Product\ProductNotFoundException;
use App\Model\Product\ProductRepository;
use Nette;
use Nette\Application\BadRequestException;

final class ProductPresenter extends Nette\Application\UI\Presenter
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
        ]);
    }

}
