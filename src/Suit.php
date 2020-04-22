<?php

declare(strict_types=1);

namespace App;

class Suit
{
    private array $cards = [];

    private int $totalCards;

    public function __construct(int $totalCards = 52)
    {
        $this->cards = range(1, $totalCards);
        $this->totalCards = $totalCards;
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    /**
     * @return Card[]
     */
    public function slice(int $currentSlice = 1, int $totalSlice = 1): array
    {
        $length = intval($this->totalCards / $totalSlice);
        $offset = ($currentSlice * $length) - $length;

        return array_map(function(int $value): Card {
            return new Card($value);
        }, array_slice($this->cards, $offset, $length));
    }
}