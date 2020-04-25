<?php

declare(strict_types=1);

namespace App;

use App\Collection\CardCollection;
use App\Collection\PlayerCollection;
use App\Collection\RoundCollection;

final class Game
{
    private PlayerCollection $players;

    private const START = 1;

    public function __construct(int $totalPlayers, int $totalCards, bool $shuffle)
    {
        $this->players = new PlayerCollection();
        $cards = CardCollection::create(range(static::START, $totalCards));

        if ($shuffle) {
            $cards = $cards->shuffle();
        }

        foreach (range(static::START, $totalPlayers) as $i) {
            $this->players->append(new Player("Player $i", $cards->slice($i, $totalPlayers)));
        }
    }

    public function getPlayers(): PlayerCollection
    {
        return $this->players;
    }

    public function getRounds(): RoundCollection
    {
        return (new RoundCollection())->addPlayers($this->players);
    }

    public function getWinner(): Player
    {
        return $this->getRounds()->getWinner();
    }
}
