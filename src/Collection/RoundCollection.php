<?php

declare(strict_types=1);

namespace App\Collection;

use App\Round;

class RoundCollection extends \IteratorIterator
{
    public function __construct(PlayerCollection $players)
    {
        $iterator = new \MultipleIterator();

        foreach ($players as $player) {
            $iterator->attachIterator($player->getCards());
        }

        parent::__construct($iterator);
    }

    /** @return Round[] */
    public function getArrayCopy(): array
    {
        return \iterator_to_array($this, false);
    }

    public function current(): Round
    {
        return new Round(new CardCollection(parent::current()));
    }
}
