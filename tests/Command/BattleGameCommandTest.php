<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Collection\CardCollection;
use App\Collection\PlayerCollection;
use App\Collection\RoundCollection;
use App\Collection\ShuffleCardInterface;
use App\Command\BattleGameCommand;
use App\Game;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class BattleGameCommandTest extends TestCase
{
    public function testRun(): void
    {
        $cards = static::createMock(ShuffleCardInterface::class);
        $cards->method('shuffle')->willReturn(CardCollection::range(4));

        $command = new CommandTester(new BattleGameCommand(new Game(), new PlayerCollection(), $cards));
        $command->setInputs([2, 4, 'John', 'Peter']);
        $command->execute([]);

        static::assertStringContainsString("Winner is : Peter", $command->getDisplay(true));
    }

    public function testPlayerAreEquals(): void
    {
        $cards = static::createMock(ShuffleCardInterface::class);
        $cards->method('shuffle')->willReturn(CardCollection::range(4));

        $rounds = static::createMock(RoundCollection::class);
        $rounds->method('getWinner')->willReturn(null);

        $game = static::createMock(Game::class);
        $game->method('run')->willReturn($rounds);
        $game->method('getPlayers')->willReturn(new PlayerCollection());

        $command = new CommandTester(new BattleGameCommand($game, new PlayerCollection(), $cards));
        $command->setInputs([2, 4, 'John', 'Peter']);
        $command->execute([]);

        static::assertStringContainsString("Players are equals", $command->getDisplay(true));
    }
}
