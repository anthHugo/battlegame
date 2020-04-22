<?php

declare(strict_types=1);

namespace App;

class Round
{
    /** @var int[] */
    private array $cards = [];

    public function __construct(array $cards)
    {
        foreach($cards as $playerId => $card) {
            $this->cards[$playerId] = $card->getValue();
        }
    }

    public function getMax(): int
    {
        return max($this->cards);
    }

    public function getWinnerId()
    {
        return array_search($this->getMax(), $this->cards);
    }

    /**
     * @return int[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }
}