<?php

declare(strict_types=1);

namespace App;

use App\Collection\CardCollection;

class Suit
{
    /** @var int[] */
    private array $cards = [];

    private int $totalCards;

    public function __construct(int $totalCards)
    {
        $this->cards = range(1, $totalCards);
        $this->totalCards = $totalCards;
    }

    public function shuffle(): self
    {
        shuffle($this->cards);

        return $this;
    }

    public function get(int $currentSlice, int $totalSlice): CardCollection
    {
        if ($totalSlice <= 0) {
            $totalSlice = 1;
        }

        $length = intval($this->totalCards / $totalSlice);
        $offset = ($currentSlice * $length) - $length;

        return new CardCollection(array_slice($this->cards, $offset, $length));
    }
}
