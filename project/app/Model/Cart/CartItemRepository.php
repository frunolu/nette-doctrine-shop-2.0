<?php

namespace App\Model\Cart;

use Doctrine\ORM\EntityRepository;

class CartItemRepository extends EntityRepository
{
    public function getCartItemsForUser($userId)
    {
        return $this->createQueryBuilder('c')
            ->where('c.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }
}
