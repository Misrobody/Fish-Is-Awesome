<?php

/**
 * @brief Initializes a SQLite database and executes an SQL import file.
 *
 * This script performs three operations:
 *
 *   1. Creates a PDO connection to a local SQLite database file
 *      (database.sqlite). If the file does not exist, SQLite will create it.
 *
 *   2. Enables PDO exception mode so that any SQL or connection error
 *      immediately throws an exception instead of failing silently.
 *
 *   3. Loads and executes the SQL instructions contained in poissons_img.sql.
 *      This file typically contains:
 *         - table creation statements
 *         - INSERT statements
 *         - initial data population
 *
 * The script is intended to be run once during setup or whenever the database
 * needs to be rebuilt from the SQL source file.
 *
 * No output is produced unless an exception is thrown.
 */

$db = new PDO('sqlite:database.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = file_get_contents('default_db.sql');
$db->exec($sql);

?>