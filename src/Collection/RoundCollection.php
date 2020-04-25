<?php

declare(strict_types=1);

namespace App\Collection;

use App\Player;
use App\Round;

class RoundCollection extends \MultipleIterator
{
    private PlayerCollection $players;

    private const DEFAULT_RESULT = 0;

    public function addPlayers(PlayerCollection $players): self
    {
        $this->players = $players;

        foreach ($this->players as $player) {
            $this->attachIterator($player->getCards());
        }

        return $this;
    }

    /** @return Round[] */
    public function current(): array
    {
        return [new Round(parent::current())];
    }

    /** @return array[] */
    public function getCards(): array
    {
        return \array_map(
            fn ($round) => \current($round)->getCards(),
            iterator_to_array($this, false)
        );
    }

    public function getWinner(): Player
    {
        $results = \array_fill_keys($this->players->getPlayerIds(), static::DEFAULT_RESULT);

        foreach ($this as $round) {
            $results[\current($round)->getWinnerId()]++;
        }

        $player = $this->players->getPlayer($this->findWinnerId($results));

        if (is_null($player)) {
            throw new \Exception('Player not found');
        }

        return $player;
    }

    /** @param int[] $results */
    private function findWinnerId(array $results): string
    {
        return \array_search(\max($results), $results, true);
    }
}
