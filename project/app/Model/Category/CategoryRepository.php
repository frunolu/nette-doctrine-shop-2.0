<?php
declare(strict_types=1);

namespace App\Model\Category;

use App\Model\BaseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\ResultSetMapping;

class CategoryRepository extends BaseRepository
{

    protected function getEntityName(): string
    {
        return Category::class;
    }

    /**
     * @param int $id
     * @return Category
     * @throws CategoryNotFoundException
     */
    public function getById(int $id): Category
    {
        /** @var Category $category */
        $category = $this->find($id);
        if ($category === null) {
            throw CategoryNotFoundException::byPrimaryKey($id);
        }

        return $category;
    }

    /**
     * @param string $url
     * @return Category
     * @throws CategoryNotFoundException
     */
    public function getByUrl(string $url): Category
    {
        $category = $this->findOne(['url' => $url]);
        if ($category instanceof Category === false) {
            throw CategoryNotFoundException::byUrl($url);
        }

        return $category;
    }


    /**
     * @param string $url
     * @return Category
     * @throws CategoryNotFoundException
     * @throws NonUniqueResultException
     */
    public function getByUrlWithQB(string $url): Category
    {
        /** @var Category $category */
        try {
            $category = $this->entityManager->createQueryBuilder()
                ->select('c')
                ->from($this->getEntityName(), 'c')
                ->where('c.url = :url')
                ->andWhere('c.deleted = 0')
                ->setParameter('url', $url)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            throw CategoryNotFoundException::byUrl($url);
        }

        return $category;
    }

    /**
     * @param string $url
     * @return Category
     * @throws CategoryNotFoundException
     * @throws NonUniqueResultException
     */
    public function getByUrlWithDQL(string $url): Category
    {
        try {
            $category = $this->entityManager
                ->createQuery(
                    sprintf(
                        'SELECT c FROM %s c WHERE c.url = :url AND c.deleted = 0',
                        $this->getEntityName()
                    )
                )
                ->setParameter('url', $url)
                ->getSingleResult();
        } catch (NoResultException $e) {
            throw CategoryNotFoundException::byUrl($url);
        }

        return $category;
    }

    /**
     * @param string $url
     * @return Category
     * @throws CategoryNotFoundException
     * @throws NonUniqueResultException
     */
    public function getAllByNativeQuery(string $url): Category
    {
        $resultSetMapping = new ResultSetMapping();
        $resultSetMapping
            ->addScalarResult(Category::COLUMN_ID, Category::COLUMN_ID, Types::INTEGER)
            ->addScalarResult(Category::COLUMN_PARENT, Category::COLUMN_PARENT, Types::STRING)
            ->addScalarResult(Category::COLUMN_NAME, Category::COLUMN_NAME, Types::STRING)
            ->addScalarResult(Category::COLUMN_URL, Category::COLUMN_URL, Types::STRING)
            ->addScalarResult(Category::COLUMN_CREATED, Category::COLUMN_CREATED, Types::DATETIME_IMMUTABLE)
            ->addScalarResult(Category::COLUMN_UPDATED, Category::COLUMN_UPDATED, Types::DATETIME_IMMUTABLE)
            ->addScalarResult(Category::COLUMN_DELETED, Category::COLUMN_DELETED, Types::INTEGER);

        try {
            $category = $this->entityManager
                ->createNativeQuery(
                    sprintf('SELECT * FROM %s AS c WHERE c.url = :url AND c.deleted = 0', Category::TABLE_NAME),
                    $resultSetMapping
                )
                ->setParameter('url', $url)
                ->getSingleResult();
        } catch (NoResultException $e) {
            throw CategoryNotFoundException::byUrl($url);
        }

        return Category::createFromArray($category);
    }

}
