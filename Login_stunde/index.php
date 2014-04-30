<?php
/**
* Created by PhpStorm.
* Eigentümer des Gedankengutes: Sven Mielke
* Protokollführer: Dennis Wellen
* Date: 14.04.14
* Time: 22:33
*/
/**
 * Die Funktion schreiben, die aufgerufen wird, sobald man sich angemeldet hat.
 */
function privater_Bereich(){
 ?>
 <!-- Verweis darauf, dass man bereits angemeldet ist. Möglichkeit auf die Login-Seite (login.php) -->
 <!-- zu wechseln.-->
 <a href="login.php">
    Sie sind bereits angemeldet. Bitte hier klicken.
 </a>

<?php
}

/**
 * Die Funktion, die die Elemente für die Anmeldeseite herstellen. Diese Funktion wird nach dem
 * erstellen der Session und unter der Bedingung aufgerufen, dass der Nutzer noch nicht
 * angemeldet ist.
 */
function anmeldung(){
    ?>
    <!-- Ab hier gibt es HTML-Code. -->

    <!--Ein Form-Element wird in HTML dafür genutzt, ein User-Input zu erstellen.-->
    <form method="post" action="login.php">
        <!-- Erstellen eines Textfeldes (type="text") mit dem Namen: 'User'. Wahlweise kann hier -->
        <!-- noch ein value (Defaultwert) mitgegeben werden.-->
        <input type="text" name="user">
        <!-- Erstellen eines Textfeldes (type="text") mit dem Namen: 'Password'. Wahlweise kann hier -->
        <!-- noch ein value (Defaultwert) mitgegeben werden.-->
        <input type="password" name="password">
        <!-- Erstellen eine "Buttons", der die eingegebenen Daten übermittelt... -->
        <input type="submit" value="Senden">
    </form>
<?php
    //Ab hier wieder PHP-Code. ;)
}
//Wenn keine Session-ID existiert, dann soll eine Session gestartet werden. Kann auch mit session_status genutzt werden(??).
if(!session_id()){
    //Starten einer PHP-Session.
    session_start();
}

// Mit 'isset' überprüft man, ob die Variable 'angemeldet' gesetzt ist. Wenn diese mit TRUE belegt ist, ist man
// also angemeldet.
if(isset($_SESSION['angemeldet']) && $_SESSION['angemeldet']){
    privater_Bereich();
//Wenn man noch nicht angemeldet, soll die Anmeldungsview angezeigt werden.
}else{
    anmeldung();
}