<?php

declare(strict_types=1);

namespace App\Collection;

use App\Player;

class PlayerCollection extends \ArrayIterator
{
    /** @param Player[] $array */
    public function __construct(array $array = [])
    {
        parent::__construct(array_filter($array, fn ($value) => $value instanceof Player));
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

    /** @return string[] */
    public function getPlayerIds(): array
    {
        return array_map(fn (Player $player) => $player->getId(), $this->getArrayCopy());
    }
}
