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
        private $img;

        function __construct()
        {
            $this->setWord();
            $this->wordLetters = str_split($this->word, 1);
            $this->correctLetters = array();
            $this->wrongLetters = array();
            $this->strikes = 0;
            $this->displayString = "";
            $this->victory = false;
            $this->img = '/img/0.jpg';
        }

        function setWord()
        {
            $rando = rand(0, 11);
            $this->word = $_SESSION['words'][$rando];
        }

        function getWrongLetters()
        {
            return implode(", ", $this->wrongLetters);
        }

        function guessLetter($letter)
        {
            $letter = strtoupper($letter);
            if ($this->strikes == 6) {
                return;
            } elseif (in_array($letter, $this->wrongLetters)) {
                return;
            } elseif (in_array($letter, $this->wordLetters)) {
                array_push($this->correctLetters, $letter);
            } else {
                array_push($this->wrongLetters, $letter);
                $this->strikes++;
                $this->img = '/img/' . strval($this->strikes) . '.jpg';
            }
        }

        function getVictory()
        {
            return $this->victory;
        }

        function getImage()
        {
            return $this->img;
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
            $displayArray = str_split($this->displayString, 1);
            $this->displayString = implode(" ", $displayArray);
            return $this->displayString;
        }
    }
?>
