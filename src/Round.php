<?php

declare(strict_types=1);

namespace App;

use App\Collection\CardCollection;

class Round
{
    private CardCollection $cards;

    public function __construct(CardCollection $cards)
    {
        $this->cards = $cards;
    }

    public function getCards(): CardCollection
    {
        return $this->cards;
    }

    public function getWinnerId(): ?string
    {
        return $this->cards->getMax()->getIdentifier();
    }
}
