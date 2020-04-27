<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\BattleGameCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class BattleGameCommandTest extends TestCase
{
    public function testRun(): void
    {
        $command = new CommandTester(new BattleGameCommand(false));
        $command->setInputs([2, 4, 'John', 'Peter']);
        $command->execute([]);

        static::assertStringContainsString("Winner is : Peter", $command->getDisplay(true));
    }

    public function testRunWithThreePlayer(): void
    {
        $command = new CommandTester(new BattleGameCommand(false));
        $command->setInputs([3, 6, 'John', 'Peter', 'Ted']);
        $command->execute([]);

        static::assertStringContainsString("Winner is : Ted", $command->getDisplay(true));
    }
}
