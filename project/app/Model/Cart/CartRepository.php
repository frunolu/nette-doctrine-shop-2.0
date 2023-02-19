<?php

namespace App\Model\Cart;

use App\Model\Product\Product;
use Doctrine\ORM\EntityManager;

class CartRepository
{
    /** @var EntityManager */
    private $entityManager;
    private $session;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addItem($productId, $quantity = 1)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        $this->setCart($cart);
    }

    public function removeItem($productId)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        $this->setCart($cart);
    }

    public function clear()
    {
        $this->setCart([]);
    }

    public function getItems()
    {
        $cart = $this->getCart();

        if (empty($cart)) {
            return [];
        }

        $productIds = array_keys($cart);
        $products = $this->entityManager->getRepository(Product::class)->findBy(['id' => $productIds]);

        $items = [];

        foreach ($products as $product) {
            $items[] = [
                'product' => $product,
                'quantity' => $cart[$product->getId()],
                'total' => $product->getPrice() * $cart[$product->getId()]
            ];
        }

        return $items;
    }

    public function getCount()
    {
        $cart = $this->getCart();

        $count = 0;

        foreach ($cart as $quantity) {
            $count += $quantity;
        }

        return $count;
    }

    public function getTotal()
    {
        $items = $this->getItems();

        $total = 0;

        foreach ($items as $item) {
            $total += $item['total'];
        }

        return $total;
    }

    private function getCart()
    {
        return $this->session->getSection('cart')->getData();
    }

    private function setCart($cart)
    {
        $this->session->getSection('cart')->setData($cart);
    }

}
