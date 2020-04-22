<?php

declare(strict_types=1);

namespace App;

class GameResults
{
    /**
     * @var Round[]
     */
    private array $rounds;

    /**
     * @var Player[]
     */
    private array $players;

    public function __construct(array $players, array $rounds)
    {
        $this->players = $players;
        $this->rounds = $rounds;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getRounds(): array
    {
        return $this->rounds;
    }

    public function getWinner(): Player
    {
        $results = [];
        foreach ($this->rounds as $round) {
            if (false === array_key_exists($round->getWinnerId(), $results)) {
                $results[$round->getWinnerId()] = 0;
            }
            $results[$round->getWinnerId()]++;
        }

        $winnerId = array_search(max($results), $results);

        return $this->players[$winnerId];
    }
}