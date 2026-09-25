# Fish Is Awesome

<div align="center">
<img src="https://media.giphy.com/media/R87MzW5xaWZO0/giphy.gif" width=300>
</div>

Fish Is Awesome is a lightweight local‑first application designed to help you manage your fish inventory without relying on massive cloud platforms or external services. Your data stays on your machine, where it belongs.

With a simple interface and classic CRUD operations, Fish Is Awesome lets you create, update, browse, and delete entries for every fish in your stock. No tracking, no analytics, no billion‑dollar companies watching your trout.

## Features

- Full CRUD workflow for fish entries
- Local SQLite database
- Image upload and validation
- Lightweight PHP backend
- Simple HTML/CSS interface
- Zero external dependencies

## Why This Exists

Maybe you never dreamed of managing fish inventory. That’s fine. Fish Is Awesome exists anyway, because sometimes the world needs a tiny, stubborn app that does one thing well and keeps your data out of corporate hands.

## Tech Stack

- PHP
- SQLite
- HTML
- CSS

## Requirements

- PHP 8.0+
- pdo
- pdo_sqlite
- sqlite3
- fileinfo
- SQLite 3.x
- Local write access for the database file
- Any modern browser

## Launch

To run Fish Is Awesome locally, you can start the PHP server manually or use the provided launch script.

### Manual Launch
From the project root:

```bash
php -S localhost:7000 -t public
```

Then open your browser and go to:

```text
http://localhost:7000
```

### Launch Script

A convenience script (launch.sh) is included to start the server and automatically open the application in Chrome (WSL-compatible):

Run it with:

```bash
./launch.sh
```
