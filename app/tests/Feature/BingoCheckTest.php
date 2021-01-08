<?php

namespace Tests\Feature;

use App\BingoCard;
use App\BingoCheck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BingoCheckTest extends TestCase
{
    public function testCalledBingoAfterAllNumberCalled()
    {
        $bingoCard = new BingoCard();
        $bingoCard->setNumbersInColumn("B", 1, 15);
        $bingoCard->setNumbersInColumn("I", 16, 30);
        $bingoCard->setNumbersInColumn("N", 31, 45);
        $bingoCard->setNumbersInColumn("G", 46, 60);
        $bingoCard->setNumbersInColumn("O", 61, 75);


        $calledNumbers = [];
        foreach ($bingoCard->getCard() as $column => $numbers) {
            foreach ($numbers as $number) {
                $calledNumbers[] = [$column, $number];
            }
        }

        $bingoCheck = new BingoCheck();
        $response = $bingoCheck->callBingo($bingoCard, $calledNumbers);

        $this->assertTrue($response);
    }

    public function testCalledBingoBeforeAllNumberCalled()
    {
        $bingoCard = new BingoCard();
        $bingoCard->setNumbersInColumn("B", 1, 15);
        $bingoCard->setNumbersInColumn("I", 16, 30);
        $bingoCard->setNumbersInColumn("N", 31, 45);
        $bingoCard->setNumbersInColumn("G", 46, 60);
        $bingoCard->setNumbersInColumn("O", 61, 75);


        $calledNumbers = [];
        foreach ($bingoCard->getCard() as $column => $numbers) {
            foreach ($numbers as $number) {
                $calledNumbers[] = [$column, $number];
            }
        }
        $calledNumbers = array_slice($calledNumbers, 0, 10);

        $bingoCheck = new BingoCheck();
        $response = $bingoCheck->callBingo($bingoCard, $calledNumbers);

        $this->assertFalse($response);
    }
}
