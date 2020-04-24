<?php

declare(strict_types=1);

namespace App\Collection;

use App\Player;

class PlayerCollection extends \ArrayIterator
{
    public function __construct($array = [], $flags = 0)
    {
        parent::__construct(array_filter($array, fn ($value) => $value instanceof Player), $flags);
    }

    public function current(): Player
    {
        return parent::current();
    }

    public function getPlayer(string $id): ?Player
    {
        foreach ($this as $player) {
            if ($player->getId() === $id) {
                return $player;
            }
        }

        return null;
    }

    public function getPlayerIds(): array
    {
        return array_map(fn (Player $player) => $player->getId(), $this->getArrayCopy());
    }
}