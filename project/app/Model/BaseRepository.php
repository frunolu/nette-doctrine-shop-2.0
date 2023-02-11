<?php
declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class BaseRepository
{
    protected EntityManagerInterface $entityManager;

    protected EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository($this->getEntityName());
    }

    /**
     * @return class-string
     */
    abstract protected function getEntityName(): string;

    public function getRepository(): EntityRepository
    {
        return $this->repository;
    }
    /**
     * @param mixed $id
     * @return object|null
     */
    public function find($id): ?object
    {
        return $this->entityManager->getRepository($this->getEntityName())->find($id);
    }

    public function findOne(array $criteria, ?array $orderBy = null): ?object
    {
        return $this->entityManager->getRepository($this->getEntityName())->findOneBy($criteria, $orderBy);
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return object[]
     */
    public function findBy(array $criteria, ?array $orderBy = null, int $limit = null, int $offset = null): array
    {
        return $this->entityManager->getRepository($this->getEntityName())->findBy(
            $criteria,
            $orderBy,
            $limit,
            $offset
        );
    }

    /**
     * @return object[]
     */
    public function findAll(): array
    {
        return $this->entityManager->getRepository($this->getEntityName())->findAll();
    }
}
