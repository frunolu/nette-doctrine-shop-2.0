<?php
declare(strict_types=1);

namespace App\Model\Product;

use App\Model\BaseRepository;

class ProductRepository extends BaseRepository
{

    protected function getEntityName(): string
    {
        return Product::class;
    }

    /**
     * @param int $id
     * @return Product
     * @throws ProductNotFoundException
     */
    public function getById(int $id): Product
    {
        /** @var Product $product */
        $product = $this->find($id);
        if ($product === null) {
            throw ProductNotFoundException::byPrimaryKey($id);
        }

        return $product;
    }

    /**
     * @param string $url
     * @return Product
     * @throws ProductNotFoundException
     */
    public function getByUrl(string $url): Product
    {
        $product = $this->findOne(['url' => $url]);
        if ($product instanceof Product === false) {
            throw ProductNotFoundException::byUrl($url);
        }

        return $product;
    }

}
