<?php
//Version Finale
session_start();
//On vérifie qu'un score est envoyé en POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['score'])) {
    $pseudo = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : 'Unknown';
    $score = intval($_POST['score']);

    $file = 'scores.txt';

    
    $existing = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

    $duplicate = false;
    foreach ($existing as $line) {
        list($p, $s) = explode(',', $line);
        if ($p == $pseudo && intval($s) == $score) 
        {
            $duplicate = true;
            break;
        }
    }

    if (!$duplicate) 
    {
        $line = $pseudo . "," . $score . PHP_EOL;
        file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
    }

    echo "Score saved.";
} 
else 
{
    echo "Invalid request.";
}

?>

