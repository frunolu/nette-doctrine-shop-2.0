<?php

namespace App\AdminModule\Presenters;

use App\Model\User\User;
use App\Model\User\UserNotFoundException;
use App\Model\User\UserRepository;


class LoggedPresenter extends BasePresenter
{
    /** @var User */
    private $loggedUser;

    /** @var UserRepository @inject */
    public UserRepository $userRepository;

    /**
     * @throws \Nette\Application\AbortException
     */
    protected function startup()
    {
        parent::startup();
        if(!$this->getUser()->isLoggedIn()) {
            $this->redirect("Sign:in");
        }
    }


    /**
     * @return User
     * @throws UserNotFoundException
     */
    public function getLoggedUser(): User
    {
        if($this->loggedUser == null) {
            $this->loggedUser = $this->userRepository->getById($this->getUser()->getId());
        }
        return $this->loggedUser;
    }

    /**
     *
     */
    public function beforeRender()
    {
        parent::beforeRender();
        $this->getTemplate()->user = $this->getUser();
        $this->getTemplate()->loggedUser = $this->getLoggedUser();
    }
}
