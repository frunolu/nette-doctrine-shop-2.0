<?php

namespace App\Model\Order;

use Doctrine\ORM\EntityRepository;
use App\Model\Order\Order;
use App\Events\OrderCreatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

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

    public function findAllOrdered()
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getTotalRevenue()
    {
        return $this->createQueryBuilder('o')
            ->select('SUM(o.total) as total')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
