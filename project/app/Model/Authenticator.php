<?php

namespace App\Model;

use App\Model\User\UserRepository;
use Nette;
use Nette\Security\SimpleIdentity;

class Authenticator implements \Nette\Security\Authenticator
{

    public function __construct(
        private UserRepository $userRepository,
        private Nette\Security\Passwords $passwords,
    )
    {}

    /**
     * @throws Nette\Security\AuthenticationException
     * @throws User\UserNotFoundException
     */
    public function authenticate(string $username, string $password): SimpleIdentity
    {
        $user = $this->userRepository->getByName($username);

        if (!$user) {
            throw new Nette\Security\AuthenticationException('User not found.');
        }

        if (!$this->passwords->verify($password, $user->getPassword())) {
            throw new Nette\Security\AuthenticationException('Invalid password.');
        }

        return new SimpleIdentity(
            $user->getId(),
            '',
            ['name' => $user->getName()],
        );
    }

}
