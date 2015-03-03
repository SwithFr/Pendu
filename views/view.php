<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Le pendu</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

</head>
<body>
    <div class="content">
        <h1>Jeu du pendu</h1>
        <?php if(!empty($message)): ?>
            <p class="message" ><?= $message; ?></p>
        <?php endif; ?>
        <h2>Mot à deviner :</h2>
        <p class="hiddenWord"><?= $hiddenWord; ?></p>

        <?php if(!isset($loose) && !isset($win)): ?>
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
        <?php endif; ?>
        <?php if(isset($win) && $win): ?>
            <a class="win" href="<?php echo $_SERVER['PHP_SELF']; ?>">Rejouer ?</a>
        <?php elseif(isset($loose) && $loose): ?>
            <a class="loose" href="<?php echo $_SERVER['PHP_SELF']; ?>">Un autre essai ?</a>
        <?php endif; ?>
        <?php if(!isset($loose)): ?>
            <h3>Attention, il vous reste <?= MAX_TRY-$attempt; ?> essais</h3>
        <?php endif; ?>
        <ul>
            <?php foreach($usedLettersList as $letter): ?>
                <li><?= $letter; ?></li>
            <?php endforeach; ?>
        </ul>
        <img src="images/<?= $attempt ?>.jpg" />
    </div>
    <script src=​"https:​/​/​ajax.googleapis.com/​ajax/​libs/​jquery/​1.11.2/​jquery.min.js">​</script>​
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>