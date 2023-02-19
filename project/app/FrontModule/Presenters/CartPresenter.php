<?php

namespace App\FrontModule\Presenters;

class CartPresenter extends BasePresenter
{
    /** @var CartManager @inject */
    public $cartManager;

    public function renderDefault()
    {
        $this->template->items = $this->cartManager->getItems();
        $this->template->total = $this->cartManager->getTotal();
    }

    public function handleRemove($id)
    {
        $this->cartManager->removeItem($id);
        $this->flashMessage('Product has been removed from cart.');
        $this->redirect('this');
    }

    public function handleClear()
    {
        $this->cartManager->clear();
        $this->flashMessage('Cart has been cleared.');
        $this->redirect('this');
    }

    public function createComponentCartForm()
    {
        $form = new \Nette\Application\UI\Form;

        foreach ($this->cartManager->getItems() as $item) {
            $productId = $item['product']->getId();
            $form->addInteger("quantity_$productId", $item['product']->getName())
                ->setDefaultValue($item['quantity'])
                ->setHtmlAttribute('min', 0);
        }

        $form->addSubmit('update', 'Update cart');
        $form->addSubmit('checkout', 'Proceed to checkout');

        $form->onSuccess[] = [$this, 'cartFormSuccess'];

        return $form;
    }

    public function cartFormSuccess(\Nette\Application\UI\Form $form, $values)
    {
        foreach ($values as $name => $quantity) {
            if (strpos($name, 'quantity_') === 0) {
                $productId = substr($name, strlen('quantity_'));
                $this->cartManager->addItem($productId, $quantity);
            }
        }

        if ($form['checkout']->isSubmittedBy()) {
            $this->redirect('Checkout:');
        } else {
            $this->flashMessage('Cart has been updated.');
            $this->redirect('this');
        }
    }
}
