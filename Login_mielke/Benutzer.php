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

    private $id = 0 ;
    private $username = '' ;
    private $email = '' ;


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
        $this->db_link = new mysqli('localhost','root','','dbphp');

        //Wenn es bei dem Verbindungsaufbau ein Problem gab, so soll auf der PHP-Seite ausgegeben werden.
        //Nur zu Entwicklungszwecken. In produktion kann so etwas einem Angreifer wertvolle Informationen liefern.
        if($this->db_link->connect_error){
            /* 'die();' in PHP --> 'System.exit(0);' in Java.
             * connect_errno gibt den Fehlernummer aus.
             * connect_error gibt die fehlermeldung aus.
             *
             * Mit dem '$this->db_link' muss hier gearbeitet werden, da die Variable 'db_link' eine Variable
             * dieses Objekts ist.
             *
             */
            die('Connect Error ('. $this->db_link->connect_errno .')
            '. $this->db_link->connect_error);
        }

        /*
         * Die Anfrage auf die Datenbanken ausführen und speichern der SELECT-Abfrage in einem '$result'.
         * Wenn man das mit Java vergleicht ist das das '$result' ein ResultSet...
         *
         * Die Entscheidung das Passwort bereits hier zu hashen ist gefallen, da man
         * sonst auf dem Weg zur Datenbank das Passwort noch im Klartext übertragen würde. Die Funktion
         * 'hash()' kann man sich unter folgendem Link mal ansehen.  http://www.php.net/manual/de/function.hash.php
         */
        //ACHTUNG: SQL muss noch escaped werden.
        $sql = 'SELECT * FROM dbphp.user WHERE user.username =\''.$name.
        '\' AND user.password =\''.hash('md5', $passwd).'\';';
        if(!$result = $this->db_link->query($sql)){
            //Auch hier wieder prüfen ob es Fehler gab.
            die('Fehler ' . $this->db_link->errno . ': ' . $this->db_link->error);
        }

        //Ein Benutzer wurde gefunden!
        if($result->num_rows == 1){
            //Benutzerinformationen in Benutzer Objekt speichern.
            $user = $result->fetch_array();
            $this->id = $user['user_id'];
            $this->username = $user['username'];
            $this->email = $user['email'];
        }
        else{
            echo 'Anmeldedaten waren nicht korrekt. ';
        }
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
} 