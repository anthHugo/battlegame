<?php

declare(strict_types=1);

namespace App\Command;

use App\Game;
use App\Player;
use App\Round;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class BattleGameCommand extends Command
{
    private const PLAYERS = 2;
    private const CARDS = 52;
    private const SUCCESS = 0;

    private bool $shuffle;

    public function __construct(bool $shuffle)
    {
        $this->shuffle = $shuffle;

        parent::__construct('game:run');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $style = new SymfonyStyle($input, $output);

        $game = new Game(
            \intval($style->askQuestion(new Question('Number of player ?', static::PLAYERS))),
            \intval($style->askQuestion(new Question('Number of cards ?', static::CARDS))),
            $this->shuffle
        );

        $style->table(
            array_map(function (Player $player) use ($style): Player {
                $player->setName(
                    $style->askQuestion(new Question("Name of player $player ?", $player->getName()))
                );

                return $player;
            }, $game->getPlayers()->getArrayCopy()),
            array_map(function (Round $round) {
                return $round->getCards()->getArrayCopy();
            }, $game->getRounds()->getArrayCopy())
        );

        $style->write('Winner is : ' . $game->getWinner()->getName() . "\r\n");

        return static::SUCCESS;
    }
}
