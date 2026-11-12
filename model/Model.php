<?php
/*Dans le fichier Model.php, créez la classe Model. 
Son constructeur instancie un objet de connexion PDO. */

require_once __DIR__ . '/../env.php';
class Model {
    //ATTRIBUT
    private PDO $pdo;

    //CONSTRUCTEUR
    public function __construct(){
        $this->pdo = $this->connect();
    }
       //GETTER ET SETTER
    /**
     * Get the value of pdo
     *
     * @return PDO
     */
    public function getPdo(): PDO {
        return $this->pdo;
    }

    /**
     * Set the value of pdo
     *
     * @param PDO $pdo
     *
     * @return self
     */
    // Method
function connect():PDO{
    try{
        return new PDO("mysql:host={$_ENV['dbhost']};dbname={$_ENV['dbname']}",$_ENV['login'],$_ENV['password']);

    }catch(Exception $error){
        http_response_code(500);
        //En mode Debug (environnement de développement), laisse le message de debug pour le développeur
        if ($_ENV['debug']) {
            die("<h1>Erreur BDD : " . htmlentities($error->getMessage()) . "</h1>");
        }
        //Message pour l'utilisateur : le bon code HTTP et un message neutre
        die("<h1>Service momentanément indisponible. Veuillez réessayer plus tard.</h1>");
    }
}
}
?>
