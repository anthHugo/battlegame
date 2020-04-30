<?php

declare(strict_types=1);

namespace App\Collection;

use App\Player;
use App\Round;

class RoundCollection extends \NoRewindIterator
{
    private PlayerCollection $players;

    private const DEFAULT_RESULT = 0;

    /** @var array<string, int>  */
    private array $results = [];

    public function __construct(PlayerCollection $players)
    {
        $this->players = $players;
        $this->results = \array_fill_keys($this->players->getPlayerIds(), static::DEFAULT_RESULT);

        $iterator = new \MultipleIterator();

        foreach ($this->players as $player) {
            $iterator->attachIterator($player->getCards());
        }

        parent::__construct($iterator);
    }

    /** @return Round[] */
    public function getArrayCopy(): array
    {
        return \iterator_to_array($this, false);
    }

    public function current(): Round
    {
        $round = new Round(new CardCollection(parent::current()));
        $winnerId = $round->getWinnerId();

        if (\is_null($winnerId)) {
            return $round;
        }

        if (\array_key_exists($winnerId, $this->results)) {
            $this->results[$winnerId]++;
        }

        return $round;
    }

    public function getWinner(): ?Player
    {
        if ($this->getInnerIterator()->valid()) {
            \iterator_to_array($this, false);
        }

        if (\is_null($this->findWinnerId())) {
            return null;
        }

        return $this->players->getPlayer($this->findWinnerId());
    }

    private function findWinnerId(): ?string
    {
        $values = array_count_values($this->results);
        $max = \max($this->results);

        if ($values[$max] > 1) {
            return null;
        }

        return array_flip($this->results)[$max];
    }
}
