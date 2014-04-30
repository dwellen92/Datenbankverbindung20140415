<?php
/**
 * Created by PhpStorm.
 * Eigentümer des Gedankengutes: Sven Mielke
 * Protokollführer: Dennis Wellen
 * Date: 15.04.14
 * Time: 16:25
 */
session_start();
?>
<!-- Man ist hat sich nach einer Anmeldung abgemeldet und bekommt die Möglichkeit wieder auf die -->
<!-- Anmeldeseite (index.php) zu wechseln.-->
Sie sind abgemeldet.
<!-- HTML-Link auf die Anmeldeseite (index.php)-->
<a href="index.php"> Hier</a>
koennen Sie sich wieder anmelden.

<?php
//Beenden der Anmelde-Session.
session_destroy();
?>