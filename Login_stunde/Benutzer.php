<?php
/**
 * Diese Klasse stellte einen angemeldeten Benutzer auf der Webseite dar.
 *
 * Eigentümer des Gedankengutes: Sven Mielke
 * Protokollführer: Dennis Wellen
 * Date: 15.04.14
 * Time: 16:40
 */

class Benutzer {

    /**
     * Diese Klassenvariable soll die Datenbankverbindung darstellen. Sie wird zu Beginn mit 'null' initialisiert, muss
     * jedoch hier definiert werden, damit Sie in allen Methoden der Klasse genutzt werden kann. War erst nur für die
     * Methode 'login' vorgesehen.
     */
    private $db_link;

    /**
     * Diese Methode sorgt dafür, dass ein Benutzer mit den übergebenen Parametern
     * für die Web-Anwendung angemeldet werden kann.
     * @param $name - Der Loginname des Nutzers.
     * @param $passwd - Das Passwort des Nuters im Klartext.
     */
    public function login($name, $passwd){
        /*
         * Aufbauen der Datenbankverbindung mit folgenden Parametern:
         * server - in diesem Fall ist der Servername localhost. Die Angabe des Ports ist optional
         * DB-User - der Anmeldename des Datenbankusers, der vorher über das Web-Interface von
         *           PHPMyAdmin erstellt wurde...
         * Passwort - Das Passwort des Datenbankusers.
         * DB-Name - Der Name der Datenbank, mit der gearbeitet werden soll.
         *
         * Eigentlichen hätten die Parameter 'server','DB-User' und 'Passwort' aus der php.ini
         * gelesen werden sollen. Warum das nicht funktioniert hat ist allerdings noch offen...
         *
         * !!! MÜSST IHR NATÜRLICH ANPASSEN !!!
         */
        $this->db_link = new mysqli("localhost:3306","dennis","monday34","dbphp");

        //Wenn es bei dem Verbindungsaufbau ein Problem gab, so soll auf der PHP-Seite(??) angezeigt werden.
        if($this->db_link->connect_error){
            /* 'die();' in PHP --> 'System.exit(0);' in Java.
             * connect_errno gibt den Fehlernummer aus.
             * connect_error gibt die fehlermeldung aus.
             *
             * Mit dem '$this->db_link' muss hier gearbeitet werden, da die Variable 'db_link' eine Variable
             * dieser Klasse ist.
             *
             */
            die('Connect Error ('. $this->db_link->connect_errno .')
            '. $this->db_link->connect_error);
        }

        /*
         * Die Anfrage auf die Datenbanken ausführen und speichern der SELECT-Abfrage in einem '$result'.
         * Wenn man das mit Java vergleicht ist das das '$result' ein ResultSet...
         *
         * Die Entscheidung das Passwort bereits hier zu hashen (verschlüsseln(??)) ist gefallen, da man
         * sonst auf dem Weg zur Datenbank das Passwort noch im Klartext übertragen würde. Die Funktion
         * 'hash()' kann man sich unter folgendem Link mal ansehen.  http://www.php.net/manual/de/function.hash.php
         */
        $result = $this->db_link->query('SELECT * FROM dbphp.user WHERE user.username ='.$name.'
        AND user.password ='.hash('md5', $passwd).';');

        //Umwandeln des $result in ein Array. Hat bisher nicht funktioniert...
        print_r($result->fetch_array());
    }
} 