<?php

namespace App\Components\OrderForm;

use App\Model\Product\Product;
use App\Model\Product\ProductRepository;
use Nette\Application\UI\Form;

class OrderFormFactory
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(): Form
    {
        $form = new Form;

        // Add form fields here...

        $form->addSubmit('submit', 'Place order');

        $form->onSuccess[] = [$this, 'processOrderForm'];

        return $form;
    }

    public function processOrderForm(Form $form, array $values): void
    {
        $product = $this->productRepository->getProductById($values['productId']);

        // Create order object and save to database using a Repository
        // Send email using Messenger or Event

        $form->getPresenter()->flashMessage('Your order has been placed!');
        $form->getPresenter()->redirect('Homepage:default');
    }
}
