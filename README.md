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

## Contact

Vitor Jordão  
Email: vitorjordao@outlook.fr

---

## Acknowledgments

- [Confetti Animation Example](https://codepen.io/liu-yanlong/pen/ByaVGYx)
- [Pokémon Quiz](https://pkmnquiz.com/)
- Resources from W3Schools, MDN Web Docs, and JavaScript.info
