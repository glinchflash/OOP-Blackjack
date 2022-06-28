<?php
declare(strict_types=1);

class dealer extends player{

    private int $magicDealer;
    function __construct(object $deck)
    {
        parent::__construct($deck);
        $this->magicDealer = 15;
    }

    public function hit($deck): void
    {

        do{
            parent::hit($deck);
        }while
        (parent::getScore()<=$this->magicDealer);

    }
}