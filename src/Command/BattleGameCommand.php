<?php

declare(strict_types=1);

namespace App\Command;

use App\Collection\PlayerCollection;
use App\Collection\ShuffleCardInterface;
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
    private const START = 1;

    private ShuffleCardInterface $shuffleCard;

    private Game $game;

    private PlayerCollection $players;

    public function __construct(Game $game, PlayerCollection $players, ShuffleCardInterface $shuffleCard)
    {
        $this->game = $game;
        $this->players = $players;
        $this->shuffleCard = $shuffleCard;

        parent::__construct('game:run');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $style = new SymfonyStyle($input, $output);
        $nbPlayers = \intval($style->askQuestion(new Question('Number of player ?', static::PLAYERS)));
        $nbCards = \intval($style->askQuestion(new Question('Number of cards ?', static::CARDS)));

        $cards = $this->shuffleCard->shuffle($nbCards);
        foreach (range(static::START, $nbPlayers) as $i) {
            $this->players->addPlayer(new Player("Player $i", $cards->slice(\intval($i), $nbPlayers)));
        }

        $this->game->setPlayers($this->players);

        $rounds = $this->game->run();

        $style->table(
            array_map(function (Player $player) use ($style): Player {
                $player->setName(
                    $style->askQuestion(new Question("Name of player $player ?", $player->getName()))
                );

                return $player;
            }, $this->game->getPlayers()->getArrayCopy()),
            array_map(function (Round $round) {
                return $round->getCards()->getArrayCopy();
            }, $rounds->getArrayCopy())
        );

        $style->write(
            \is_null($rounds->getWinner())
                ? "Players are equals\r\n"
                : 'Winner is : ' . $rounds->getWinner()->getName() . "\r\n"
        );

        return static::SUCCESS;
    }
}
