<?php

declare(strict_types=1);

namespace App;

use App\Collection\PlayerCollection;
use App\Collection\RoundCollection;

class Game
{
    private PlayerCollection $players;

    public function __construct()
    {
        $this->players = new PlayerCollection();
    }

    public static function create(int $nbPlayers, int $totalCards, bool $shuffle = true): self
    {
        $instance = new static();
        $suit = new Suit($totalCards);

        if ($shuffle) {
            $suit->shuffle();
        }

        for ($i = 1; $i <= $nbPlayers; $i++) {
            $instance->addPlayer(new Player("Player $i", $suit->get($i, $nbPlayers)));
        }

        return $instance;
    }

    public function addPlayer(Player $player): self
    {
        $this->players->append($player);

        return $this;
    }

    public function getPlayers(): PlayerCollection
    {
        return $this->players;
    }

    public function getRounds(): RoundCollection
    {
        return new RoundCollection($this->players);
    }

    public function getWinner(): Player
    {
        return $this->getRounds()->getWinner();
    }
}