<?php
//Define DB credentials
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'restaurant';

//Paths

const BASE_PATH = 'cle3/';


set_error_handler(/**
 * @throws ErrorException
 */ function (int $severity, string $message, string $file, int $line): bool|null {
    if ((error_reporting() & $severity) === 0) {
        return null;
    }
    throw new ErrorException($message, $severity, $severity, $file, $line);
});

