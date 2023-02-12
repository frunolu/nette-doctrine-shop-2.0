<?php
declare(strict_types=1);

namespace App\Model\User;

use Exception;

final class UserNotFoundException extends Exception
{
    public static function byPrimaryKey(int $userId): self
    {
        return new self(sprintf('User with id: %d not found', $userId));
    }

    public static function byName(string $name): self
    {
        return new self(sprintf('User with name: %s not found', $name));
    }
}
