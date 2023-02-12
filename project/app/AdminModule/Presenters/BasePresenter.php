<?php

namespace App\AdminModule\Presenters;

use Nette\DI\Container as DIC;

class BasePresenter extends \Nette\Application\UI\Presenter
{
    private $context;

    public function injectContext(DIC $context)
    {
        $this->context = $context;
    }

    public function getContext(): DIC
    {
        return $this->context;
    }

    protected function startup()
    {
        parent::startup();
        $user = parent::getUser();
        $authenticator = $this->getContext()->getService('authenticator');
        $user->setAuthenticator($authenticator);
    }

}
