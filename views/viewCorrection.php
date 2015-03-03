<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Le pendu</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>

<h1>Jeu du pendu</h1>
<?php if(!empty($message)): ?>
    <p><?= $message; ?></p>
<?php endif; ?>
<h2>Mot à devine : <?= $hiddenWord; ?></h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <label for="lettre">Selectionnez une lettre</label>

    <select name="letter" id="letter">
        <?php foreach($dispoLettersSelect as $letter => $dispo): ?>
            <?php if($dispo): ?>
                <option value="<?= $letter ?>"><?= $letter ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>

    <input type="hidden" name="index" value="<?= $index; ?>"/>
    <input type="hidden" name="hiddenWord" value="<?= $hiddenWord; ?>"/>
    <input type="hidden" name="attempt" value="<?= $attempt; ?>"/>
    <input type="hidden" name="usedLetters" value="<?= $usedLetters; ?>"/>
    <input type="hidden" name="dispoLetters" value="<?= $dispoLetters; ?>"/>
    <input type="submit" value="Essayer"/>

</form>

<h3>Attention il vous reste <?= MAX_TRY-$attempt; ?> essais</h3>
<ul>
    <?php foreach($usedLettersList as $letter): ?>
        <li><?= $letter; ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>