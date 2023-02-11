<?php
declare(strict_types=1);

namespace App\Model\Category;

use Exception;

final class CategoryNotFoundException extends Exception
{
    public static function byPrimaryKey(int $productId): self
    {
        return new self(sprintf('Category with id: %d not found', $productId));
    }

    public static function byUrl(string $url): self
    {
        return new self(sprintf('Category with url: %s not found', $url));
    }
}
