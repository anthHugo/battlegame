<?php

declare(strict_types=1);

namespace App\Command;

use App\Game;
use App\Player;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class BattleGameCommand extends Command
{
    private const PLAYERS = 2;
    private const CARDS = 52;

    private bool $shuffle;

    public function __construct(bool $shuffle = true)
    {
        $this->shuffle = $shuffle;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('game:run')
            ->setDescription('Run a new game')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);

        $game = Game::create(
            \intval($style->askQuestion(new Question('Number of player ?', static::PLAYERS))),
            \intval($style->askQuestion(new Question('Number of cards ?', static::CARDS))),
            $this->shuffle
        );

        $style->table(
            array_map(function (Player $player) use ($style): Player {
                $player->setName(
                    $style->askQuestion(new Question("Name of player $player ?", (string) $player))
                );

                return $player;
            }, $game->getPlayers()->getArrayCopy()),
            $game->getRounds()->getCards()
        );

        $style->write('Winner is : ' . $game->getWinner()->getName());
        $style->newLine(2);

        return 0;
    }
}