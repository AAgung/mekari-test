<?php

namespace App;

class Test
{
    private $aLyric = [],
        $aLyricLength = 0;

    /**
     * convert string lyric to array lyric with delimeter '::'
     * @param string $lyric
     * 
     */
    public function __construct($lyric = '')
    {
        $this->aLyric = $lyric ? array_map(function($each) {
            return trim($each, " \t\n\r");
        }, explode('::', $lyric)) : []; // delete whitespace if exists
        $this->aLyricLength = count($this->aLyric);
    }
    
    /**
     * get lyric by number row input
     * @param bool $rowRandom
     * @param int $rowNo
     * @return string
     */
    public function getLyricByRow($rowRandom = false, $rowNo = 0)
    {
        if($rowRandom) $rowNo = rand(1, $this->aLyricLength); // row random is true, it will generate No between 1 and the lenght of array
        if($rowNo <= 0 || $rowNo > $this->aLyricLength) return 'input must be between number of lyric lines';
        if($this->aLyricLength <= 0) return 'No Lyrics detected';

        $result = [];
        for($i = ($this->aLyricLength - $rowNo); $i < $this->aLyricLength; $i++) {
            $result[] = $this->aLyric[$i];
        }
        return 'This is '.implode(' ', $result);
    }

    /**
     * get lyric subject by number row input from the lyric
     * subject is all string before 'that' from the lyric
     * @param bool $rowRandom
     * @param int $rowNo
     * @return string
     */
    public function getLyricSubjectByRow($rowRandom = false, $rowNo = 0)
    {
        if($rowRandom) $rowNo = rand(1, $this->aLyricLength); // row random is true, it will generate No between 1 and the lenght of array
        if($rowNo <= 0 || $rowNo > $this->aLyricLength) return 'input must be between number of lyric lines';
        if($this->aLyricLength <= 0) return 'No Lyrics detected';

        $result = [];
        for($i = ($this->aLyricLength - $rowNo); $i < $this->aLyricLength; $i++) {
            $aCurrLyric = explode('that', $this->aLyric[$i]);
            $result[] = trim($aCurrLyric[0]);
        }

        if(count($result) == 1) 
            return 'This is '.$result[0];
        $lastResult = $result[count($result) - 1]; // get last index from result array
        $result = array_slice($result, 0 , -1); // remove last index from result array
        return 'This is '.implode(', ', $result).' and '.$lastResult;
    }
}