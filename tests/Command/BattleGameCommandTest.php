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

        static::assertStringContainsString("
 ------ ------- 
  John   Peter  
 ------ ------- 
  1      3      
  2      4      
 ------ ------- 

Winner is : Peter",
            $command->getDisplay(true)
        );
    }

    public function testRunWithThreePlayer(): void
    {
        $command = new CommandTester(new BattleGameCommand(false));
        $command->setInputs([3, 6, 'John', 'Peter', 'Ted']);
        $command->execute([]);

        static::assertStringContainsString("
 ------ ------- ----- 
  John   Peter   Ted  
 ------ ------- ----- 
  1      3       5    
  2      4       6    
 ------ ------- ----- 

Winner is : Ted",
            $command->getDisplay(true)
        );
    }
}