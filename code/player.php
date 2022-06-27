<?php
declare(strict_types=1);


require 'code/Deck.php';
require 'code/Suit.php';
require 'code/Card.php';
require 'code/blackjack.php';
class player
{
    private array $cards;
    private bool $lost;
    private int $magic;

    public function __construct(array $deck){
        $this->magic = 21;
        (new blackjack)->getDeck();
        $this->getCards();
    }

    public function getScore(){

    }

    public function hit($deck){
        $this->drawCard();
        $this->getScore();
        if ($this->getScore()>$this->magic){
            $this->lost=true;
        }
    }

    public function surrender(){
        $this->lost=true;
    }


    public function hasLost(){
        return $this->lost;
    }

}
