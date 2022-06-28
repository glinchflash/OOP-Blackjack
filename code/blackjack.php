<?php
declare(strict_types=1);

class blackjack{

    private object $player;
    private object $dealer;
    private object $deck;
    private bool $gameOver = false;

    public function __construct(){
        $this->deck = new Deck();
        $this->deck->shuffle();
        $this->player = new player($this->deck);
        $this->dealer = new dealer($this->deck);
    }


    public function getPlayer():object{
       return $this->player;

    }

    public function getDealer():object{
        return $this->dealer;
    }

    public function getDeck():object{
        return $this->deck;

    }

    public function getGameOver():bool{
        return $this->gameOver;
    }

    public function setGameOver($gameOver):void{
        $this->gameOver = $gameOver;
    }
}
