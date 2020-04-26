<?php

declare(strict_types=1);

namespace App;

use App\Collection\CardCollection;
use App\Collection\PlayerCollection;
use App\Collection\RoundCollection;

class Game
{
    private PlayerCollection $players;

    private const START = 1;
    private const DEFAULT_RESULT = 0;

    public function __construct(int $totalPlayers, int $totalCards, bool $shuffle)
    {
        $this->players = new PlayerCollection();
        $cards = CardCollection::range($totalCards);

        if ($shuffle) {
            $cards = $cards->shuffle();
        }

        foreach (range(static::START, $totalPlayers) as $i) {
            $this->players->append(new Player("Player $i", $cards->slice(\intval($i), $totalPlayers)));
        }
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
        $results = \array_fill_keys($this->players->getPlayerIds(), static::DEFAULT_RESULT);

        foreach ($this->getRounds() as $round) {
            if (\is_string($round->getWinnerId())) {
                $results[$round->getWinnerId()]++;
            }
        }

        $player = $this->players->getPlayer($this->findWinnerId($results));

        if (\is_null($player)) {
            throw new \Exception('Player not found');
        }

        return $player;
    }

    /** @param int[] $results */
    private function findWinnerId(array $results = []): string
    {
        return \array_search(\max($results), $results, true);
    }
}
