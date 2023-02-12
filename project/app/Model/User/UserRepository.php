<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Model\BaseRepository;

class UserRepository extends BaseRepository
{

    protected function getEntityName(): string
    {
        return User::class;
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function getById(int $id): User
    {
        /** @var User $user */
        $user = $this->find($id);
        if ($user === null) {
            throw UserNotFoundException::byPrimaryKey($id);
        }

        return $user;
    }

    /**
     * @param string $name
     * @return User
     * @throws UserNotFoundException
     */
    public function getByName(string $name): User
    {
        $user = $this->findOne(['name' => $name]);
        if ($user instanceof User === false) {
            throw UserNotFoundException::byName($name);
        }

        return $user;
    }

    public function register(  string $name, string $password): User
    {
        $user = new User();
        $user->setName($name);
        $user->setPassword($password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
