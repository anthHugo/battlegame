<?php

declare(strict_types=1);

namespace App;

class BattleGame
{
    private Game $game;

    public function __construct(int $nbPlayers = 2, int $totalCards = 52, bool $shuffle = true)
    {
        $this->game = new Game();

        $suit = new Suit($totalCards);

        if ($shuffle) {
            $suit->shuffle();
        }

        for ($i = 1; $i <= $nbPlayers; $i++) {
            $this->game->addPlayer(new Player("Player $i", $suit->slice($i, $nbPlayers)));
        }
    }

    public function output(): void
    {
        $title = '|';
        foreach ($this->game->getPlayers() as $player) {
            $title .= "  $player  |";
        }

        $line = '';
        foreach ($this->game->getRounds() as $round) {
            $line .= '|';
            foreach ($this->game->getPlayers() as $player) {
                $cardValue = $round->getCards()[$player->getId()];
                $line .= str_repeat(' ', strlen($player->getName()) - strlen(((string) $cardValue)) + 2)
                    . $cardValue . "  |";
            }

            $line .= "\r\n";
        }

        $output = str_repeat('=', strlen($title))."\r\n";
        $output .= str_repeat(' ', intval(strlen($title) / 2) - 5) . "BattleGame\r\n";
        $output .= str_repeat('=', strlen($title))."\r\n";
        $output .= str_repeat('-', strlen($title))."\r\n";
        $output .= $title;
        $output .= "\r\n" . str_repeat('-', strlen($title))."\r\n";
        $output .= $line;
        $output .= str_repeat('-', strlen($title))."\r\n";
        $output .= "\r\nWinner is : " . $this->game->getWinner() . "\r\n\r\n";

        echo $output;
    }
}