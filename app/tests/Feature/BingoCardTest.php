<?php

namespace Tests\Feature;

use App\BingoCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BingoCardTest extends TestCase
{
    public function testRandomUniqueNumbersBetween()
    {
        $bingoCard = new BingoCard();
        $min = 1;
        $max = 15;
        $numbers = $bingoCard->randomUniqueNumbersBetween($min, $max);
        
        $isNumberBetweenRange = true;
        foreach ($numbers as $number) {
            if ($number < $min || $number > $max) {
                $isNumberBetweenRange = false;
            }
        }
        $this->assertTrue($isNumberBetweenRange);
    }

    public function testSetUniqueNumbersInColumn()
    {
        $min = 1;
        $max = 15;
        $bingoCard = new BingoCard();
        $bingoCard->setNumbersInColumn("B", $min, $max);
        $response = array_unique($bingoCard->getColumn("B"));
        $this->assertCount(5, $response);
    }

    public function testGenerateCard()
    {
        $bingoCard = new BingoCard();
        $bingoCard->setNumbersInColumn("B", 1, 15);
        $bingoCard->setNumbersInColumn("I", 16, 30);
        $bingoCard->setNumbersInColumn("N", 31, 45);
        $bingoCard->setNumbersInColumn("G", 46, 60);
        $bingoCard->setNumbersInColumn("O", 61, 75);

        $response = array_unique(array_merge(
            $bingoCard->getColumn("B"), 
            $bingoCard->getColumn("I"),
            $bingoCard->getColumn("N"),
            $bingoCard->getColumn("G"),
            $bingoCard->getColumn("O")
        ));
        $this->assertCount(25, $response);
    }

    public function testGeneratedCardHasFreeSpaceInTheMiddle()
    {
        $bingoCard = new BingoCard();
        $bingoCard->setNumbersInColumn("B", 1, 15);
        $bingoCard->setNumbersInColumn("I", 16, 30);
        $bingoCard->setNumbersInColumn("N", 31, 45);
        $bingoCard->setNumbersInColumn("G", 46, 60);
        $bingoCard->setNumbersInColumn("O", 61, 75);

        $response = array_unique(array_merge(
            $bingoCard->getColumn("B"), 
            $bingoCard->getColumn("I"),
            $bingoCard->getColumn("N"),
            $bingoCard->getColumn("G"),
            $bingoCard->getColumn("O")
        ));
        $this->assertEquals(0, $response[12]);
    }
}
