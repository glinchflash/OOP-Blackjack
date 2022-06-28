<?php
declare(strict_types=1);

//required files
require 'code/blackjack.php';
require 'code/player.php';
require 'code/Deck.php';
require 'code/Suit.php';
require 'code/Card.php';
require 'code/dealer.php';

//to start session to keep game state
if (!isset($_SESSION)){
    session_start();
}

if (empty($_SESSION['blackjack'])){
    $blackjack = new blackjack();
    $_SESSION['blackjack']= $blackjack;
}

//functionality of buttons
if (isset($_POST['hit'])){
    if($_SESSION['blackjack']->getPlayer()->hasLost() === false){
        $_SESSION['blackjack']->getPlayer()->hit($_SESSION['blackjack']->getDeck());
    }else echo "You already lost!";
    checkPlayer();
}

if (isset($_POST['surrender'])){
    $this->surrender();
}

if (isset($_POST['stand'])){
    $_SESSION['blackjack']->getDealer()->hit();
    checkDealer();
}


function checkPlayer():void{

    if($_SESSION['blackjack']->getPlayer()->hasLost() === true){
        echo "Dealer won!";
    }
}



function checkDealer():void{

    if($_SESSION['blackjack']->getDealer()->hasLost() === true){
        echo "You won!";
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>OOP-Blackjack</title>
</head>
<body>
<h1 class="text-center">Blackjack</h1>
<div class="container align-items center">
    <div class="row align-items-center">
        <div class="col-6 text-left">Player
            <div class="row">
                <?php foreach($_SESSION['blackjack']->getPlayer()->getCards() AS $card):?>
                    <div style="text-align:center; font-size:100px;" class="row card col-lg-3">
                        <?= $card->getUnicodeCharacter(true);?>
                    </div>
                <?php endforeach;?>
            </div>
            <?php
            echo "Player score: ". $_SESSION['blackjack']->getPlayer()->getScore();
            ?>
        </div>
        <div class="col-6 text-left">Dealer
            <div class="row">
                <?php foreach($_SESSION['blackjack']->getDealer()->getCards() AS $card):?>
                    <div style="text-align:center; font-size:100px;" class="row card col-lg-3">
                        <?= $card->getUnicodeCharacter(true);?>
                    </div>
                <?php endforeach;?>
            </div>
            <?php
            echo "Dealer score: ". $_SESSION['blackjack']->getDealer()->getScore();
            ?>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-12 col-md-4 offset-md-4">
            <form action="index.php" method="post">
                <button type="submit" name="hit" class="btn btn-lg btn-success">Hit</button>
                <button type="submit" name="stand" class="btn btn-lg btn-warning">Stand</button>
                <button type="submit" name="surrender" class="btn btn-lg btn-danger">Surrender</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php
unset($_SESSION['blackjack']);
?>