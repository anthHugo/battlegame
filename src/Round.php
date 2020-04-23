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

    public function getWinnerId(): string
    {
        return (string) array_search(max($this->cards), $this->cards);
    }

    /**
     * @return int[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }
}