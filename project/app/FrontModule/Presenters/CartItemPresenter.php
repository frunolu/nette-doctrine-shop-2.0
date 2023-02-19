<?php

namespace App\FrontModule\Presenters;


use App\Model\Cart\CartItemRepository;
use Nette\Application\UI\Presenter;

class CartItemPresenter extends Presenter
{
    private CartItemRepository $cartItemRepository;

    public function __construct(CartItemRepository $cartItemRepository)
    {
        parent::__construct();
        $this->cartItemRepository = $cartItemRepository;
    }

    // ...
}
