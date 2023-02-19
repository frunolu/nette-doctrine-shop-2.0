<?php

namespace App\FrontModule\Presenters;


use App\Model\Cart\CartItemRepository;
use Nette\Application\UI\Presenter;

class CartPresenter extends Presenter
{
    private CartItemRepository $cartItemRepository;

    public function __construct(CartItemRepository $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    // ...
}
