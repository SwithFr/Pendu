<?php

/**
 * Génère un index aléatoire pour trouver un mot au hazard
 * @return int
 */
function getRandomIndex(){
    return array_rand(file(WORDS_LIST_PATH));
}

/**
 * Récupère le mot à l'index demandé
 * @param $index  l'index du mot que l'on veut
 * @return string le mot
 */
function getWord($index){
    $words = file(WORDS_LIST_PATH);
    return trim($words[$index]);
}

/**
 * Vérifie si la lettre demandée par l'utilisateur fait partie ou non du mot
 * @param string $letter la lettre demandée
 * @param string $word le mot à deviner
 * @return bool
 */
function isAGoodLetter($letter,$word){
    $l = strlen($word);
    $i=0;
    while($i<$l){
        if(substr($word,$i,1) == $letter){
            return true;
        }
        $i++;
    }

    return false;
}

/**
 * Permet de "crypter" le mot (remplace les lettres par '-')
 * @return int $index
 */
function cryptWord($index){
    $l = strlen(getWord($index));
    $i=1;
    $word = "";
    while($i<=$l){
       $word .= CHAR_REPLACE;
        $i++;
    }

    return $word;
}

/**
 * Permet d'afficher les lettres si elles font partie du mot à deviner
 * @param string $letter la lettre testée par l'utilisateur
 * @param string $word   le mot à deviner
 * @param string $cryptedWord   le mot crypter
 * @return string        Le mot crypté/décrypté
 */
function showLetters($letter,$word,$cryptedWord){
    $word = preg_split('//',$word);
    $cryptedWord = preg_split('//',$cryptedWord);
    $l = count($word);

    for($i=0;$i<$l;$i++){
        if($word[$i] === $letter)
            $cryptedWord[$i] = $letter;
    }

    return implode('',$cryptedWord);
}

/**
 * Permet de générer une chaine de caractères à partir d'un tableau
 * @param array $array
 * @return string
 */
function arrayToString(Array $array){
    return urlencode(serialize($array));
}

/**
 * Permet de générer un tableau à partir d'une chaine de caractères
 * @param $string
 * @return array
 */
function stringToArray($string){
    return unserialize(urldecode($string));
}

/**
 * PREMIÈRE VERSION BIEN NAZE
 * Permet de récupérer les lettres disponnibles
 * @param null $usedLetters Les les déjà utilisées.
 * @return array
 */
function getDispoLetters($usedLetters=null){
    $base = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
    if($usedLetters){
        return array_diff($base,$usedLetters);
    }
    return $base;
}

/**
 * Permet de définir une lettre jouée
 * @param string $letter
 * @param array $dispoLetters
 * @return array
 */
function setLetter($letter,Array $dispoLetters){
    $dispoLetters[$letter] = false;
    return $dispoLetters;
}

/**
 * Renvoie le tableau des lettres initial
 * @return array
 */
function initLetters(){
    return [
        'a'=>true,
        'b'=>true,
        'c'=>true,
        'd'=>true,
        'e'=>true,
        'f'=>true,
        'g'=>true,
        'h'=>true,
        'i'=>true,
        'j'=>true,
        'k'=>true,
        'l'=>true,
        'm'=>true,
        'n'=>true,
        'o'=>true,
        'p'=>true,
        'q'=>true,
        'r'=>true,
        's'=>true,
        't'=>true,
        'u'=>true,
        'v'=>true,
        'w'=>true,
        'x'=>true,
        'y'=>true,
        'z'=>true
    ];
}

/**
 * Permet de savoir si le mot à été trouvé (plus de _ dans le mot caché)
 * @param $hiddenWord
 */
function isWin($hiddenWord){
    return !preg_match('/-/',$hiddenWord);
}

function gameOver(){
    header("Location: index.php?success=true");
    exit();
}