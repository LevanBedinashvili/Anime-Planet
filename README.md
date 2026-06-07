# Anime-Planet 🪐

**Anime-Planet** is a modern, responsive, and feature-rich web application designed for anime enthusiasts. Discover top-rated series, browse airing schedules, find random anime to watch, and manage your personal catalog in a sleek, dark-themed UI.

What makes this project truly special is its foundation: **Anime-Planet is powered by ForgeMVC**, a custom-built, lightweight, Laravel-like PHP framework crafted from scratch!

---

## 🚀 Features

- **Dynamic Data**: Integrates seamlessly with the [Jikan API](https://jikan.moe/) to fetch real-time data from MyAnimeList (MAL).
- **Weekly Schedule**: Check out the airing schedule to see which new episodes are dropping from Monday to Sunday.
- **Top Anime & Catalog**: Browse through the highest-rated anime and discover new favorites.
- **Random Anime**: Use the "Surprise Me" (გამაოცე) feature to get a random anime recommendation.
- **User Authentication**: Secure Login and Registration system to keep your personal watchlist safe.
- **Responsive UI**: A beautiful, premium dark mode design with micro-animations, glassmorphism, and seamless mobile support using Owl Carousel and vanilla CSS.

---

## 🛠 Built With ForgeMVC

This application is built entirely on **ForgeMVC**, a custom PHP framework that mimics the elegant syntax and robust architecture of Laravel. 

**ForgeMVC Highlights:**
- **MVC Architecture**: Strict separation of Models, Views, and Controllers.
- **Routing Engine**: Intuitive and powerful route definitions (`get`, `post`, middleware grouping).
- **IoC Container**: Built-in Dependency Injection container with auto-wiring capabilities.
- **Middleware & Security**: Built-in CSRF protection, Authentication filters, and Session management.
- **Database ORM**: Custom base `Model` providing active record capabilities and relationships (`hasMany`, `belongsTo`) over PDO.
- **Templating**: A lightweight view compiler that supports layouts, partials, and data injection.
- **CLI Tooling**: Comes with a `forge` command-line utility for database migrations and queue workers.

## 💻 Installation

### Prerequisites
- **PHP >= 8.2**
- **Composer**
- A local web server (XAMPP, Laragon, Valet, etc.)
- Database (MySQL, SQLite, etc.)

### Setup Instructions

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/anime-planet.git
   cd anime-planet
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Environment Configuration:**
   Copy the `.env.example` to `.env` and configure your database credentials.
   ```bash
   cp .env.example .env
   ```

4. **Run Migrations (Forge CLI):**
   ```bash
   php forge migrate
   ```

5. **Run the Application:**
   Point your web server document root to the `public/` directory, or use PHP's built-in server:
   ```bash
   php -S localhost:8000 -t public
   ```

6. **Enjoy Anime-Planet!**
   Open `http://localhost:8000` in your browser.

---

## 🧪 Testing

ForgeMVC comes with a comprehensive suite of PHPUnit tests covering the core framework components (Routing, DI Container, Config, Request, Session, Validation) and Application logic (API Services, Models).

To run the test suite:
```bash
vendor/bin/phpunit
```

---

## 📜 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
