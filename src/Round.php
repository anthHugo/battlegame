<?php

declare(strict_types=1);

namespace App;

use App\Collection\CardCollection;

class Round
{
    /** @var int[] */
    private array $cards = [];

    /** @param CardCollection $cards */
    public function __construct(iterable $cards)
    {
        foreach($cards as $card) {
            $this->cards[$card->getIdentifier()] = $card->getValue();
        }
    }

    /**
     * @return int[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    public function getWinnerId(): string
    {
        return array_search(max($this->cards), $this->cards);
    }
}