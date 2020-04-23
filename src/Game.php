<?php

declare(strict_types=1);

namespace App;

class Game
{
    /**
     * @var Player[]
     */
    private array $players = [];

    public function addPlayer(Player $player): self
    {
        $this->players[$player->getId()] = $player;

        return $this;
    }

    /**
     * @return Player[]
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /** @return Round[] */
    public function getRounds(): array
    {
        $iterator = new \MultipleIterator(\MultipleIterator::MIT_NEED_ALL | \MultipleIterator::MIT_KEYS_ASSOC);

        foreach ($this->players as $id => $player) {
            $iterator->attachIterator(new \ArrayIterator($player->getCards()), $id);
        }

        return array_map(function (array $round) {
            return new Round($round);
        }, iterator_to_array($iterator, false));
    }

    public function getWinner(): Player
    {
        $results = array_fill_keys(array_keys($this->players), 0);
        foreach ($this->getRounds() as $round) {
            $results[$round->getWinnerId()]++;
        }

        $winnerId = array_search(max($results), $results);

        return $this->players[$winnerId];
    }
}