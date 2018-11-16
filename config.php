<?php
/**
 * @author Bas van Evelingen <BasvanEvelingen@me.com>
 * Weekopdracht 2 maak een blog
 * Configuratiebestand voor het openen van een database connectie.
 * Database credenties , require once in andere php-bestanden
 */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'admin');
define('DB_NAME', 'basblog');
define('root_path', dirname(__FILE__), true);

/* Poging om connectie te maken met database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Connectie controleren
if($mysqli === false) {
    die("ERROR: Kon geen verbinding maken. " . $mysqli->connect_error);
}
//echo "Connectie succesvol: ";
?>
