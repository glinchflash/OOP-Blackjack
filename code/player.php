<?php
declare(strict_types=1);


class player
{
    private array $cards = [];
    private bool $lost;
    private const magic = 21;//class constant to avoid magical value

    public function __construct(object $deck){
        $this->lost = false;
        array_push($this->cards, $deck->drawCard(), $deck->drawCard()); //push 2 cards into hand of player (cards = hand, drawcard = card from deck)
//        $this->getScore(); //might be necessary to get score after hand is being dealt
    }

    public function getScore():int{
            $score = 0;
        foreach ($this->cards as $card){
            $score+=$card->getValue();
        }
        return $score;
    }

    public function hit($deck):void{
        $this->cards[] = $deck->drawCard();
        if ($this->getScore()>self::magic){
            $this->lost=true;
        }
    }

    public function surrender():void{
        $this->lost=true;
    }


    public function hasLost(): bool
    {
        return $this->lost;
    }

    public function getCards():array
    {
        return $this->cards;
    }
}



