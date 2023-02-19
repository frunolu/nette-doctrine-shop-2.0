<?php

namespace App\Components\EventDispatcher;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

// ...

class EventDispatcher
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function doSomething()
    {
        // ...

        $event = new MyEvent(/* ... */);
        $this->eventDispatcher->dispatch($event);

        // ...
    }
}
