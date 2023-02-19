<?php

namespace App\Model\Order;

use Doctrine\ORM\EntityRepository;
use App\Model\Order\Order;
use App\Events\OrderCreatedEvent;
use Doctrine\ORM\EntityManagerInterface;

class OrderRepository extends EntityRepository
{
    protected EntityManagerInterface $entityManager;
    private $dispatcher;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(Order::class));
        $this->entityManager = $entityManager;
    }

    public function createOrder(Order $order): void
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();

        $event = new OrderCreatedEvent($order);
        $this->dispatcher->dispatch($event);
    }
}
