# Guess the 151 Pokémon!

A web-based interactive quiz game where players try to identify all 151 original Pokémon from the first generation within a limited time. Built with PHP, JavaScript, HTML, and CSS, the game features dynamic content, real-time interactivity, and a simple leaderboard system. Developed as part of a web-programming introduction university module.

---

## Features

- Enter a pseudonym to start the game
- Identify Pokémon with instant feedback and sprite display
- Timer to challenge speed and accuracy
- Score tracking and leaderboard display
- No database required, scores stored in a text file
- Responsive and visually engaging with animated background and CSS effects

---

## Technologies Used

- PHP for server-side processing and score persistence
- JavaScript for client-side game logic and interactivity
- HTML and CSS for layout and styling
- XAMPP or similar local server environment for testing

---

## How to Run Locally

1. Clone or download this repository
2. Place it in your web server directory (e.g., `htdocs` for XAMPP)
3. Ensure the `scores.txt` file exists in the root directory
4. Start your local server (Apache) via XAMPP or similar
5. Access the game at `http://localhost/your-folder-name/index.php`

---

## Folder Structure

- `index.php` — Main entry point, handles session and dynamic content
- `game.js` — Handles game logic and user interaction
- `save_score.php` — Processes score submissions and saves to file
- `style.css` — Styles and layout
- `scores.txt` — Text file storing scores
- `images/` — Pokémon sprites and logos
- `video/` — Background video

---

## License

This project is for educational purposes. Feel free to use and modify it!

---

## Future Improvements and Personal Ideas

I'm excited about the potential to make this project even better, and here are some ideas I have for future improvements:

- **Add a Pokémon Database:** I want to connect with external APIs like PokéAPI to get dynamic Pokémon data and sprites, which would make it easier to update and maybe even expand beyond the original 151.
- **Implement User Accounts:** Giving players the option to create accounts so they can track their stats and progress over time sounds like a fun feature.
- **Improve UI/UX:** I plan to enhance the visual design using modern CSS frameworks like Bootstrap or adding more animations to make the game more engaging.
- **Make it More Responsive:** Ensuring the game looks great on mobile devices and tablets is definitely on my list.
- **Add Sounds:** Incorporating background music and sound effects for correct and incorrect answers would add a lot of immersion.
- **Create a Leaderboard System:** I’d like to store top scores with player names, dates, and times to encourage friendly competition.
- **Introduce Different Game Modes:** Options like timed challenges, practice mode, or even multiplayer could make the game more versatile.
- **Improve Accessibility:** Making the game more accessible for players with disabilities is important to me.
- **Refactor the Code:** Modularizing the JavaScript and PHP code will help me keep it clean and easier to maintain or expand.
- **Allow Saving Progress:** Giving players the ability to save their game and pick up where they left off could be a great addition.

These are some ideas I’m considering to improve the project. I believe they can make the experience more fun, engaging, and scalable. Feel free to suggest your own ideas or improvements!

---

## Contact

Vitor Jordão  
Email: vitorjordao@outlook.fr

---

## Acknowledgments

- [Confetti Animation Example](https://codepen.io/liu-yanlong/pen/ByaVGYx)
- [Pokémon Quiz](https://pkmnquiz.com/)
- Resources from W3Schools, MDN Web Docs, and JavaScript.info
