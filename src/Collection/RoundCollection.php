<?php

declare(strict_types=1);

namespace App\Collection;

use App\Player;
use App\Round;

class RoundCollection extends \MultipleIterator
{
    private PlayerCollection $players;

    public function __construct(PlayerCollection $players)
    {
        $this->players = $players;

        foreach ($this->players  as $player) {
            $this->attachIterator($player->getCards());
        }

        parent::__construct();
    }

    public function current(): Round
    {
        return new Round(parent::current());
    }

    public function getCards(): array
    {
        $cards = [];
        foreach ($this as $round) {
            $cards[] = $round->getCards();
        }

        return $cards;
    }

    public function getWinner(): Player
    {
        $results = array_fill_keys($this->players->getPlayerIds(), 0);

        foreach ($this as $round) {
            $results[$round->getWinnerId()]++;
        }

        $winnerId = array_search(max($results), $results);

        return $this->players->getPlayer($winnerId);
    }
}