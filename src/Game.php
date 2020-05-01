<?php

declare(strict_types=1);

namespace App;

use App\Collection\PlayerCollection;
use App\Collection\RoundCollection;

class Game
{
    private PlayerCollection $players;

    private RoundCollection $rounds;

    public function __construct(PlayerCollection $players = null)
    {
        $players = $players ?? new PlayerCollection();
        $this->setPlayers($players);
    }

    public function setPlayers(PlayerCollection $players): self
    {
        $this->players = $players;
        $this->rounds = new RoundCollection($this->players);

        return $this;
    }

    public function getPlayers(): PlayerCollection
    {
        return $this->players;
    }

    public function run(): RoundCollection
    {
        return $this->rounds;
    }
}
