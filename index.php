<?php
include('./models/model.php');
include('./configs/conf.php');

// Lorsqu'on arrive sur la page la première fois
if($_SERVER['REQUEST_METHOD'] ==="GET"){
    // On initialise le nombre d'essais
    $attempt = 0;

    // On récupère l'index du mot
    $index = getRandomIndex();

    // On récupère le mot
    $hiddenWord = cryptWord($index);

    // On initialise la variable des lettres utilisées
    $usedLetters = arrayToString([]);
    $usedLettersList = [];

    // On initialise les lettres disponnibles
    $dispoLettersSelect = initLetters();

    // On sérialise pour pouvoir passer la variable dans l'input
    $dispoLetters =  arrayToString($dispoLettersSelect);

    $message = "";

}elseif($_SERVER['REQUEST_METHOD'] ==="POST"){ // Lorsqu'on a joué une lettre
    // Récupération des variables passées en POST
    $attempt = $_POST['attempt'];
    $index = $_POST['index'];
    $word = getWord($index);
    $hiddenWord = $_POST['hiddenWord'];
    $letter = $_POST['letter'];
    $usedLettersList = stringToArray($_POST['usedLetters']);
    $usedLettersList[] = $letter;
    $dispoLetters = stringToArray($_POST['dispoLetters']);
    $dispoLettersSelect = setLetter($letter,$dispoLetters);

    if(MAX_TRY-$attempt-1 > 0){
        if(isAGoodLetter($letter,$word)){
            $hiddenWord = showLetters($letter,$word,$hiddenWord);
            if(isWin($hiddenWord)){
                $message = "Bravo, vous avez gagné !";
                $win = true;
            }
        }else{
            $attempt++;
        }
    }else{
        $attempt++;
        $message = "Vous avez perdu !";
        $loose = true;
    }

    $usedLetters = arrayToString($usedLettersList);
    $dispoLetters = arrayToString($dispoLettersSelect);
}

include('./views/view.php');