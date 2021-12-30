<?php

use \PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    private $lyrics = '
        the horse and the hound and the horn that belonged to::
        the farmer sowing his corn that kept::
        the rooster that crowed in the morn that woke::
        the priest all shaven and shorn that married::
        the man all tattered and torn that kissed::
        the maiden all forlorn that milked::
        the cow with the crumpled horn that tossed::
        the dog that worried::
        the cat that killed::
        the rat that ate::
        the malt that lay in::
        the house that Jack built
    ';

    public function testPhase1()
    {
        $test = new App\Test($this->lyrics);
        $this->assertSame('This is the house that Jack built', $test->getLyricByRow(false, 1));
        $this->assertSame('This is the malt that lay in the house that Jack built', $test->getLyricByRow(false, 2));
        $this->assertSame('This is the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built', $test->getLyricByRow(false, 5));
        $this->assertSame('input must be between number of lyric lines', $test->getLyricByRow(false, 14));
        $this->assertNotSame('This is the house that Jack built', $test->getLyricByRow(false, 3));
        $this->assertNotSame('This is the dog that worried the cat that killed the rat that ate the malt that lay in the house that Jack built', $test->getLyricByRow(false, 12));
        $this->assertNotSame('input must be between number of lyric lines', $test->getLyricByRow(false, 11));
    }

    public function testPhase2()
    {
        $test = new App\Test($this->lyrics);
        $this->assertNotSame('This is the house that Jack built', $test->getLyricByRow(true));
    }

    public function testPhase3()
    {
        $test = new App\Test($this->lyrics);
        $this->assertSame('This is the house', $test->getLyricSubjectByRow(false, 1));
        $this->assertSame('This is the malt and the house', $test->getLyricSubjectByRow(false, 2));
        $this->assertSame('This is the dog, the cat, the rat, the malt and the house', $test->getLyricSubjectByRow(false, 5));
        $this->assertSame('This is the horse and the hound and the horn, the farmer sowing his corn, the rooster, the priest all shaven and shorn, the man all tattered and torn, the maiden all forlorn, the cow with the crumpled horn, the dog, the cat, the rat, the malt and the house', $test->getLyricSubjectByRow(false, 12));
        $this->assertSame('input must be between number of lyric lines', $test->getLyricSubjectByRow(false, 14));
        $this->assertNotSame('This is the house', $test->getLyricSubjectByRow(false, 3));
        $this->assertNotSame('This is the dog, the cat, the rat, the malt and the house', $test->getLyricSubjectByRow(false, 12));
        $this->assertNotSame('input must be between number of lyric lines', $test->getLyricSubjectByRow(false, 11));
    }

    public function testPhase4()
    {
        $test = new App\Test($this->lyrics);
        $this->assertNotSame('This is the house', $test->getLyricSubjectByRow(true));
    }
}