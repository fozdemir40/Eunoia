<?php

// Define DB Credentials
define("DB_HOST", "192.168.50.5");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "eunoia");

// Emails
define("ADMIN_EMAIL", "admin@eunoia.com");
define("INFO_EMAIL", "info@eunoia.com");

// Paths
define("INCLUDES_PATH", __DIR__ . "/../");
define("LOG_PATH", "../app/logs/");
define("BASE_PATH", "/");
define("BASE_URL", "http://eunoia.local/");
define("RESOURCES_PATH", "public/");

// Custom error handler
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, $severity, $severity, $file, $line);
});
