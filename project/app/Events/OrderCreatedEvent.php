<?php

namespace App\Events;

use App\Model\Order\Order;
use Symfony\Contracts\EventDispatcher\Event;

class OrderCreatedEvent extends Event
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}
