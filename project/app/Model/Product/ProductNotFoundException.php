<?php
declare(strict_types=1);

namespace App\Model\Product;

use Exception;

final class ProductNotFoundException extends Exception
{
    public static function byPrimaryKey(int $productId): self
    {
        return new self(sprintf('Product with id: %d not found', $productId));
    }

    public static function byUrl(string $url): self
    {
        return new self(sprintf('Product with url: %s not found', $url));
    }
}
