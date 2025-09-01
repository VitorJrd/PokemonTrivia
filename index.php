<?php
    //Génére 151 "slots" vides côté PHP afin d'afficher les sprites dans l'ordre
    $pokemonList = [
    "bulbasaur", "ivysaur", "venusaur",
    "charmander","charmeleon", "charizard",
    "squirtle", "wartortle", "blastoise",
    "caterpie","metapod","butterfree",
    "weedle","kakuna","beedrill",
    "pidgey","pidgeotto","pidgeot",
    "rattata","raticate",
    "spearow","fearow",
    "ekans","arbok",
    "pikachu","raichu",
    "sandshrew","sandslash",
    "nidoran-f","nidorina","nidoqueen",
    "nidoran-m","nidorino","nidoking",
    "clefairy","clefable",
    "vulpix","ninetales",
    "jigglypuff","wigglytuff",
    "zubat","golbat",
    "oddish","gloom","vileplume",
    "paras","parasect",
    "venonat","venomoth",
    "diglett","dugtrio",
    "meowth","persian",
    "psyduck","golduck",
    "mankey","primeape",
    "growlithe","arcanine",
    "poliwag","poliwhirl","poliwrath",
    "abra","kadabra","alakazam",
    "machop","machoke","machamp",
    "bellsprout","weepinbell","victreebel",
    "tentacool","tentacruel",
    "geodude","graveler","golem",
    "ponyta","rapidash",
    "slowpoke","slowbro",
    "magnemite","magneton",
    "farfetchd",
    "doduo","dodrio",
    "seel","dewgong",
    "grimer","muk",
    "shellder","cloyster",
    "gastly","haunter","gengar",
    "onix",
    "drowzee","hypno",
    "krabby","kingler",
    "voltorb","electrode",
    "exeggcute","exeggutor",
    "cubone","marowak",
    "hitmonlee","hitmonchan",
    "lickitung",
    "koffing","weezing",
    "rhyhorn","rhydon",
    "chansey",
    "tangela",
    "kangaskhan",
    "horsea","seadra",
    "goldeen","seaking",
    "staryu","starmie",
    "mr-mime",
    "scyther",
    "jynx",
    "electabuzz",
    "magmar",
    "pinsir",
    "tauros",
    "magikarp","gyarados",
    "lapras",
    "ditto",
    "eevee","vaporeon","jolteon","flareon",
    "porygon",
    "omanyte","omastar",
    "kabuto","kabutops",
    "aerodactyl",
    "snorlax",
    "articuno","zapdos","moltres",
    "dratini","dragonair","dragonite",
    "mewtwo","mew"
    ];

session_start();    //commence la session pour stocker le pseudonyme do joueur et le score
session_unset();
session_destroy();

session_start();

$nom = '';      //nom du joueur

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pseudo'])) {
    $nom = htmlspecialchars($_POST['pseudo']);
    $_SESSION['pseudo'] = $nom;     //stocke le pseudonyme
}

if (!isset($_SESSION['scores'])) 
{
    $_SESSION['scores'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guess the 151 Pokémon!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!--Fond animé-->
<video autoplay muted loop id="bgVideo">
    <source src="video/wallpaper.mp4" type="video/mp4">
</video>

<?php if (!isset($_SESSION['pseudo'])): ?>

    <div id="mainContent">
        <h1>Welcome to the Pokémon Guessing Game!</h1>
        <p class="subtitle">Can you name all 151 Pokémon in under 20 minutes?</p>

        <form method="post" action="" id="startForm">
            <label for="pseudo">Enter your name:</label>
            <input type="text" id="pseudo" name="pseudo" required>
            <div class="button-group">
                <button type="submit">Start Game</button>
                <button type="button" id="showLeaderboardBtn">View Leaderboard</button>
            </div>
        </form>
    </div>

<?php else: ?>      <!--Si pseudonyme connu -->

    <div id="gameArea">
        <h1>Hi <?php echo $_SESSION['pseudo']; ?>, let's catch 'em all!</h1>
        <p>Time left: <span id="timer">1200</span> seconds</p>
        <div id="progressBarContainer">
            <div id="progressBar"></div>
        </div>

        <p>Score: <span id="score">0</span></p>

        <input type="text" id="guessInput" placeholder="Enter Pokémon name in English...">
        <button id="pauseButton">Pause</button>
        <button id="quitButton">Quit</button>

        <div id="sprites">
            <?php
                foreach ($pokemonList as $namePK) 
                {
                    echo '<span class="slot" id="slot-' . $namePK . '"></span>';
                }
            ?>
        </div>
    </div>


    <script>
        const pokemonList = <?php echo json_encode($pokemonList); ?>;
    </script>

    <script src="game.js"></script> <!-- Script JS du jeu -->
<?php endif; ?>
    <!--Classement (caché au début)--> 
    <div id="ranking">
    <?php
        if (file_exists('scores.txt'))
        {
            $lines = file('scores.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $all_scores = [];
            foreach ($lines as $line) 
            {
                list($pseudo, $score) = explode(',', $line);
                $all_scores[] = ['pseudo' => $pseudo, 'score' => intval($score)];
            }
            usort($all_scores, function($a, $b) {
                return $b['score'] - $a['score'];
            });
            echo "<h2>🏆 Leaderboard</h2><ol>";
            foreach ($all_scores as $entry) 
            {
            echo "<li>" . htmlspecialchars($entry['pseudo']) . " : " . $entry['score'] . "</li>";
            }
            echo "</ol>";
        }
    ?>

    <button id="returnBtn"> Return to Menu</button>

    <script>
    document.getElementById('returnBtn').addEventListener('click', () => {
        window.location.href = window.location.pathname;
    });
    </script>

    </div>

    <script>
        document.getElementById('showLeaderboardBtn').addEventListener('click', () => {
            document.getElementById('ranking').classList.add('show');
            document.querySelector('form').style.display = 'none';
            document.getElementById('showLeaderboardBtn').style.display = 'none';
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        //Fade-in de la page principale
        const mainContent = document.getElementById('mainContent');
        if (mainContent) 
        {
            mainContent.classList.add('show');
        }

        const gameArea = document.getElementById('gameArea');
        if (gameArea) 
        {
            gameArea.classList.add('show');
        }

        //Fade-in pour View Leaderboard
        const showBtn = document.getElementById('showLeaderboardBtn');
        const form = document.querySelector('form');
        const ranking = document.getElementById('ranking');
        if (showBtn && ranking && form) 
        {
            showBtn.addEventListener('click', () => {
            ranking.classList.add('show');
            form.style.display = 'none';
            showBtn.style.display = 'none';
            });
        }

        //Fade-in pour Return to Menu
        const returnBtn = document.getElementById('returnBtn');
        if (returnBtn) 
        {
            returnBtn.addEventListener('click', () => {
            window.location.href = window.location.pathname;
            });
        }
    });
    </script>

    <footer style="margin-top: 50px; text-align: center; font-size: 14px; color:  #666;">
        © 2024 Vitor Jordão - Pokémon Guessing Game | Sprite Credits go to Nintendo/GameFreak/The Pokémon Company <br>
        Animated background credits go to DesktopHut
    </footer>

</body>
</html>
