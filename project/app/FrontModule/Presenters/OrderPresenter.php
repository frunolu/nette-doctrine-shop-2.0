<?php
namespace App\FrontuModule\Presenters;

use App\Model\Order\Order;
use App\Events\OrderCreatedEvent;
use App\Model\Order\OrderRepository;
use App\Presenters\BasePresenter;
use Nette\Application\UI\Form;

class OrderPresenter extends BasePresenter
{
    /**
     * @var OrderRepository
     * @inject
     */
    public OrderRepository $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        parent::__construct();
        $this->orderRepository = $orderRepository;
    }


    public function renderDefault()
    {
        $this->template->orders = $this->orderRepository->findAllOrdered();
        $this->template->totalRevenue = $this->orderRepository->getTotalRevenue();
    }


    public function createComponentOrderForm(): Form
    {
        $form = new Form();

        // Add form fields here...

        $form->addSubmit('submit', 'Place order');

        $form->onSuccess[] = function (Form $form, array $values) {
            $order = new Order();
            $order->setUser($this->getUser()->getIdentity());
            $order->setAddress($values['address']);
            $order->setCity($values['city']);
            $order->setCountry($values['country']);
            $order->setZip($values['zip']);
            $order->setPhone($values['phone']);
            $order->setEmail($values['email']);
            $order->setComment($values['comment']);
            $order->setCreatedAt(new \DateTime());
            $order->setUpdatedAt(new \DateTime());

            $this->orderRepository->save($order);

            $this->getEventDispatcher()->dispatch(new OrderCreatedEvent($order));

            $this->flashMessage('Your order has been placed successfully.', 'success');
            $this->redirect('Homepage:default');
        };
        return $form;
    }}
