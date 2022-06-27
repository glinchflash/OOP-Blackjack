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
        $this->player = new player($deck);
        $this->dealer = new player($deck);
        $this->deck = new Deck();
        $this->deck->shuffle();
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
