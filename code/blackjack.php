<?php
declare(strict_types=1);

class blackjack{

    private object $player;
    private object $dealer;
    private object $deck;
    private bool $gameOver = false;
    private bool $endTurn = false;

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

    public function getTurn():bool{
        return $this->endTurn;
    }

    public function setTurn($endTurn):void{
        $this->endTurn = $endTurn;
    }

    public function gameLogic ():void{
    if ($this->getDealer()->hasLost()===true){
        echo '<div class="alert alert-success text-center" role="alert">';
        echo 'You won!';
        echo '</div>';
        $this->setGameOver(true);
    }
    else if ($this->getPlayer()->hasLost()===true) {
        echo '<div class="alert alert-danger text-center" role="alert">';
        echo 'Dealer won!';
        echo '</div>';
        $this->setGameOver(true);
    }

    else if ($this->getDealer()->getScore() < $this->getPlayer()->getScore()){
        $this->getDealer()->lost = true;
        echo '<div class="alert alert-success text-center" role="alert">';
        echo 'You won!';
        echo '</div>';
        $this->setGameOver(true);
    }

    else if ($this->getDealer()->getScore()>= $this->getPlayer()->getScore()){
        echo '<div class="alert alert-danger text-center" role="alert">';
        echo 'Dealer won!';
        echo '</div>';
        $this->setGameOver(true);
    }
}


}
