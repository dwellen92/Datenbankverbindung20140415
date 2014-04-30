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

//Wenn der Benutzer noch nicht angemeldet ist
if(isset($_SESSION['benutzer']) &&  $_SESSION['benutzer']->getId())
{
    $benutzer = $_SESSION['benutzer'];
    // Gaaaaanz schlechter Programmierstiel.
    goto angemeldet;
}

// Benutzerobjekt initialisieren.
$benutzer = new Benutzer();

// Inhalt der HTML-Objekte "besorgen"
$benutzer->login($_POST['user'], $_POST['password']);

// Wenn der '$benutzer' nicht angemeldet ist,...
if(!$benutzer->getId()){
    // ...dann soll es das Programm "beendet" werden.
    die('Melden Sie sich bitte <a href="index.php"> hier </a> an.');
}
// ...sonst kann folgendes ausgeführt werden.

// Den angemeldeten Benutzer in der Session speichern.
$_SESSION['benutzer'] = $benutzer;
angemeldet:
?>
    <!-- Hier steht nur HTML-Code. -->
    Hallo <?php echo $benutzer->getUsername()?>!
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