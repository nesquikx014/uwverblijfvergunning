# UwVerblijfsvergunning.nl

Simple PHP site that centralises information about Dutch residence permits and routes visitors to the right help.

## Local setup
- Install PHP 8+.
- From the repo root run `php -S localhost:8000` and open `http://localhost:8000`.
- Quick lint: `for f in *.php info/*.php; do php -l "$f"; done`.

## Project structure
- `index.php`: landing page.
- `info.php` and `info/`: knowledge-base router and articles.
- `kennisbank.php`: service overview.
- `css/style.css`, `js/main.js`: styling and lightweight behaviour.

## Contact
Questions or improvements: `info@uwverblijfsvergunning.nl`.
