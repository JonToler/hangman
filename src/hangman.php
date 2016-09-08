<?php
    class Hangman
    {
        private $word;
        private $wordLetters;
        private $displayString;
        private $correctLetters;
        private $wrongLetters;
        private $strikes;
        private $victory;

        function __construct($word)
        {
            $this->word = strtoupper($word);
            $this->wordLetters = str_split($this->word, 1);
            $this->correctLetters = array();
            $this->wrongLetters = array();
            $this->strikes = 0;
            $this->displayString = "";
            $this->victory = false;
        }

        function guessLetter($letter)
        {
            $letter = strtoupper($letter);
            if (in_array($letter, $this->wordLetters)) {
                array_push($this->correctLetters, $letter);
            } else {
                array_push($this->wrongLetters, $letter);
            }
        }

        function getGuessedString()
        {
            return implode($this->wrongLetters);
        }

        function getCorrectLetters()
        {
            return implode($this->correctLetters);
        }

        function getVictory()
        {
            return $this->victory;
        }

        function getDisplayString()
        {
            $this->displayString = "";
            foreach($this->wordLetters as $letter) {
                if (in_array($letter, $this->correctLetters)) {
                    $this->displayString .= $letter;
                } else {
                    $this->displayString .= "_";
                }
            }
            if ($this->displayString == $this->word) {
                $this->victory = true;
            }
            return $this->displayString;
        }
    }
?>
