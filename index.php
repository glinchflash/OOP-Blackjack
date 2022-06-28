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
if (!isset($_SESSION)) {
    session_start();
}
//session_start();


//if Session is empty, store new one else reload the original one
if (!isset($_SESSION['blackjack']) || isset($_POST['playAgain'])) {
    $blackjack = new blackjack();
    $_SESSION['blackjack'] = $blackjack;
} else if (isset($_SESSION["blackjack"])) {
    $blackjack = $_SESSION['blackjack'];
}

//functionality of buttons

//on hit check if player didn't lose already, if not draw a card from currently used deck -> check player to see if he has "lost"
if (isset($_POST['hit'])) {
        if ($blackjack->getGameOver() === false) {
            if ($blackjack->getPlayer()->hasLost() === false) {
                $blackjack->getPlayer()->hit($blackjack->getDeck());
            } else {
                echo '<div class="alert alert-danger text-center" role="alert">';
                echo "You already lost!";
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-warning text-center" role="alert">';
            echo "You passed your turn to the dealer!";
            echo '</div>';
        }
        if ($blackjack->getPlayer()->hasLost()===true){
            echo '<div class="alert alert-danger text-center" role="alert">';
            echo "Busted, You lose!";
            echo '</div>';
        }
}

//surrender -> to let the player give up
if (isset($_POST['surrender'])) {
    $blackjack->getPlayer()->surrender();
    echo '<div class="alert alert-danger text-center" role="alert">';
    echo "You surrender, Dealer has won by forfeit of Player";
    echo '</div>';
}

//to pass turn to dealer and check if he isn't busted
if (isset($_POST['stand'])) {
    if ($blackjack->getDealer()->hasLost() === false) {
        if ($blackjack->getDealer()->getScore() < $blackjack->getPlayer()->getScore()){
            $blackjack->getDealer()->hit($blackjack->getDeck());
            $blackjack->setGameOver(true);
        }else {
            $blackjack->getPlayer()->surrender();
            echo '<div class="alert alert-danger text-center" role="alert">';
            echo 'Dealer Won!';
            echo '</div>';
        }
    }
    if ($blackjack->getDealer()->hasLost()===true){
        echo '<div class="alert alert-success text-center" role="alert">';
        echo 'Dealer busted, You won!';
        echo '</div>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>OOP-Blackjack</title>
</head>
<body>
<h1 class="text-center">Blackjack</h1>
<div class="container align-items center">
    <div class="row align-items-center">
        <div class="col-6 text-left">Player
            <div class="row">
                <?php foreach ($blackjack->getPlayer()->getCards() as $card): ?>
                    <div style="text-align:center; font-size:100px;" class="row card col-lg-3">
                        <?= $card->getUnicodeCharacter(true); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
            echo "Player score: " . $blackjack->getPlayer()->getScore();
            ?>
        </div>
        <div class="col-6 text-left">Dealer
            <div class="row">
                <?php foreach ($blackjack->getDealer()->getCards() as $card): ?>
                    <div style="text-align:center; font-size:100px;" class="row card col-lg-3">
                        <?= $card->getUnicodeCharacter(true); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
            echo "Dealer score: " . $blackjack->getDealer()->getScore();
            ?>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-12 col-md-4 offset-md-4">
            <form action="index.php" method="post">
                <button type="submit" name="hit" class="btn btn-lg btn-success">Hit</button>
                <button type="submit" name="stand" class="btn btn-lg btn-warning">Stand</button>
                <button type="submit" name="surrender" class="btn btn-lg btn-danger">Surrender</button>
                <?php
                if (isset($_POST['surrender'])||$blackjack->getPlayer()->hasLost()===true||$blackjack->getDealer()->hasLost()===true) {
                    echo '<button type="submit" name="playAgain" class="btn btn-lg btn-warning">Play again!</button>';
                }
                ?>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</body>
</html>
