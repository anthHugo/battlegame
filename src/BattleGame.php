<?php

declare(strict_types=1);

namespace App;

class BattleGame
{
    private Game $game;

    public function __construct(int $nbPlayers = 2, int $totalCards = 52, bool $shuffle = true)
    {
        $players = [];
        $suit = new Suit($totalCards);

        if ($shuffle) {
            $suit->shuffle();
        }

        for ($i = 0; $i < $nbPlayers; $i++) {
            $players[] = new Player("Player $i", $suit->slice($i + 1, $nbPlayers));
        }

        $this->game = new Game($players);
    }

    public function output(): void
    {
        $results = $this->game->run();
        foreach ($results->getPlayers() as $player) {
            echo "$player  |";
        }
        echo "\r\n";
        foreach ($results->getRounds() as $round) {
            foreach ($results->getPlayers() as $player) {
                echo $round->getCards()[$player->getId()] . "  |";
            }
            echo "\r\n";
        }
        echo "\r\n" . $results->getWinner();
    }
}