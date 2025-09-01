//Variables globales
//Liste originale avec les 151 pokémon
console.log("Pokémon list from PHP:", pokemonList);


//Liste pokémons trouvés
const found = [];

let gameEnded= false;
let score=0;
let paused = false;
const totalTime= 1200;
let timeLeft=totalTime;

const timerElement = document.getElementById('timer');
const scoreElement = document.getElementById('score');
const guessInput = document.getElementById('guessInput');
const spritesCont = document.getElementById('sprites');

//Initialiser score et timer
timerElement.textContent=timeLeft;
scoreElement.textContent=score;

//Fonction pour le timer
//setInterval(code, delay)
const timer = setInterval(() => {
    if (!paused && !gameEnded)
    {
        timeLeft--;
        const percent = (timeLeft / totalTime) * 100;
        document.getElementById('progressBar').style.width = percent + '%';
        timerElement.textContent=timeLeft;  // on met le timer à jour toutes les secondes

        if (timeLeft<=0)    //plus de temps = jeu fini
        {
            gameEnded=true;
            clearInterval(timer);
            endGame();
        }
    }
}, 1000);

//Fonction pour récupérer la saisie de l'utilisateur et vérifier si c'est correct
guessInput.addEventListener('keyup', (e) => {
    if (gameEnded) return;

    const guess = e.target.value.trim().toLowerCase();  //on récupère la saisie et la convertit en minuscule

    //Si la liste contient le guess et que l'on n'a pas encore deviné ce pokémon spécifique
    if (pokemonList.includes(guess) && !found.includes(guess))
    {
        found.push(guess);  //on ajoute guess à la liste des trouvés
        score++;
        scoreElement.textContent=score;
        showPokemon(guess);     //fonction pour afficher le sprite
        guessInput.value='';    //pour vider le champ

        //Si l'utilisateur trouve tous les 151 noms
        if (found.length === pokemonList.length)
        {
            //gameEnded=true;
            guessInput.disabled=true;
            clearInterval(timer);
            alert("Congratulations! You have found all 151 Pokémon!");
            endGame();
        }
    }
});


//Fonction pour afficher le sprite et jouer un son
const showPokemon = (nameP) => {
    const slot = document.getElementById(`slot-${nameP}`);
    if (slot && slot.children.length===0)
    {
        //Afficher le sprite
        const img= document.createElement('img');
        img.src = "sprites/"+nameP+".png";
        img.alt= nameP;
        //img.width=80;

        slot.appendChild(img);
        
        //Jouer le son
        const audio = new Audio("sons/correct.mp3");
        audio.play();
    }
};

//Fonction de fin de jeu
const endGame = () => {
  if (gameEnded) return;
  gameEnded = true;

  guessInput.disabled = true;
  clearInterval(timer);

  //On crée un objet FormData pour POST
  const formData = new FormData();
  formData.append('score', score);

  //On envoye le score à save_score.php en POST
  fetch('save_score.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    alert(`Time's up! Your score is ${score}. ${data}Waiting 15 seconds before showing the leaderboard!`);

    pokemonList.forEach(name => {
      if (!found.includes(name)) {
        const slot = document.getElementById(`slot-${name}`);
        if (slot && slot.children.length === 0) {
          const img = document.createElement('img');
          img.src = "sprites/" + name + ".png";
          img.alt = name;
          img.classList.add('missed');
          slot.classList.add('missed');
          slot.appendChild(img);
        }
      }
    });

    //Attente avant de montrer le leaderboard
    setTimeout(() => {
      document.getElementById('gameArea').style.display = 'none';
      document.getElementById('ranking').classList.add('show');
      launchConfetti();
    }, 15000);

  });
};



//Bouton quit
document.getElementById('quitButton').addEventListener('click', () => {
    if (confirm("Are you sure you want to quit?")) 
    {
        clearInterval(timer);
        endGame();
    }
});

//Bouton pause
document.getElementById('pauseButton').addEventListener('click', () => {
    paused = !paused;
    if (paused) 
    {
        guessInput.disabled = true;
        document.getElementById('pauseButton').textContent = 'Resume';
    } 
    else 
    {
        guessInput.disabled = false;
        document.getElementById('pauseButton').textContent = 'Pause';
    }
});

function launchConfetti() {
    const duration = 20 * 1000; 
    const animationEnd = Date.now() + duration;
    const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 10000 };

    function randomInRange(min, max) {
        return Math.random() * (max - min) + min;
    }

    const interval = setInterval(function() {
        const timeLeft = animationEnd - Date.now();

        if (timeLeft <= 0) {
            return clearInterval(interval);
        }

        const particleCount = 50 * (timeLeft / duration);

        
        confetti(Object.assign({}, defaults, {
            particleCount,
            origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 }
        }));

        
        confetti(Object.assign({}, defaults, {
            particleCount,
            origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 }
        }));

    }, 250);
}
