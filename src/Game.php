<?php

declare(strict_types=1);

namespace App;

class Game
{
    /**
     * @var Player[]
     */
    private array $players = [];

    /**
     * Game constructor.
     * @param Player[] $players
     * @throws \Exception
     */
    public function __construct(array $players)
    {
        foreach ($players as $player) {
            if (false === $player instanceof Player) {
                throw new \Exception('Player must be an instance of App\Player');
            }

            $this->players[$player->getId()] = $player;
        }
    }

    public function run(): GameResults
    {
        return new GameResults($this->players, $this->getRounds());
    }

    /** @return Round[] */
    private function getRounds(): array
    {
        $iterator = new \MultipleIterator(\MultipleIterator::MIT_NEED_ALL | \MultipleIterator::MIT_KEYS_ASSOC);

        foreach ($this->players as $id => $player) {
            $iterator->attachIterator(new \ArrayIterator($player->getCards()), $id);
        }

        return array_map(function (array $round) {
            return new Round($round);
        }, iterator_to_array($iterator, false));
    }
}