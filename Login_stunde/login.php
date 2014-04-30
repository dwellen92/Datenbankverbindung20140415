<?php
require 'Benutzer.php';
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15.04.14
 * Time: 15:59
 */
//Starten einer Session. Muss für jede Seite neu gestartet werden.
session_start();
// Benutzerobjekt initialisieren.
$benutzer = new Benutzer();

// Inhalt der HTML-Objekte "besorgen"
$benutzer->login($_POST['user'], $_POST['password']);

// Wenn der '$benutzer' nicht angemeldet ist,...
if(!$benutzer->isLogin()){
    // ...dann soll es das Programm "beendet" werden.
    die('Melden Sie sich bitte <a href="index.php"> hier </a> an.');
}
// ...sonst kann folgendes ausgeführt werden.

// Den angemeldeten Benutzer in der Session speichern.
$_SESSION['benutzer'] = $benutzer;
?>
    <!-- Hier steht nur HTML-Code. -->
    Herzlich Willkommen im privaten Bereich.
    <!-- Möglichkeit der Abmeldung bieten, die auf die Seite 'logout.php' führt. -->
    <form method="post" action="logout.php">
        <!-- Einen Ausführungsbutton mit dem Namen 'abmelden' erstellen und der -->
        <!-- Beschreibung 'Abmeldung' über den Namen können die Schaltflächen aus der -->
        <!-- $_POST-Variable gelesen werden(siehe login.php Zeile 15)-->
        <input type="submit" name="abmelden" value="Abmelden">
    </form>
<?php

?>