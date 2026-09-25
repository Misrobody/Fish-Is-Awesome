#!/bin/bash

# Starts the PHP development server using the "public" directory as the document root.
# Waits briefly to ensure the server is ready.
# Opens Google Chrome (Windows installation) from WSL and loads the application.

php -S localhost:7000 -t public

sleep 1

"/mnt/c/Program Files/Google/Chrome/Application/chrome.exe" http://localhost:8000
