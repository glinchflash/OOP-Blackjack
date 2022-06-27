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

    public function __construct(object $deck){
        $this->magic = 21; //class constant to avoid magical number
        $this->cards = $deck->drawCard();
        $this->cards = $deck->drawCard();
    }

    public function getScore():int{
        $score = 0;
        foreach ($this->cards as/*$key=>*/ $value){ //not sure if $key=> is required so commented it out until later
            $score+=$value->getValue();
        }
        return $score;
    }

    public function hit($deck):void{
        $this->cards = $deck->drawCard();
        if ($this->getScore()>$this->magic){
            $this->surrender();
        }
    }

    public function surrender():void{
        $this->lost=true;
    }


    public function hasLost(): bool
    {
        return $this->lost;
    }

}
