<?php
declare(strict_types=1);

require 'code/player.php';
require 'code/Deck.php';
require 'code/Card.php';
require 'code/Suit.php';
class blackjack{

    private object $player;
    private object $dealer;
    private object $deck;


    public function __construct(){
        $this->deck = new Deck();
        $this->deck->shuffle();
        $this->player = new player($this->deck);
        $this->dealer = new player($this->deck);
    }


    public function getPlayer(){
       return $this->player;

    }

    public function getDealer(){
        return $this->dealer;
    }

    public function getDeck(){
        return $this->deck;

    }


}
