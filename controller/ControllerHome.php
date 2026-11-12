<?php
/*Dans le fichier ControllerHome.php, créez la class ControllerHome. Elle possède 2 méthodes :

1)- displayPlayers() : Elle demande au model de récupérer la totalité des players, avant de fournir ces données à la view.

2)- registerPlayer() fait plusieurs choses :
        + Vérifier que l’on reçoive bien le formulaire d’ajout de joueur
        + Mettre en place les sécurités d’usages concernant la réception de formulaire
        + Faire les vérification pour savoir si l’enregistrement a le droit de s’effectuer
        + Effectuer l’enregistrement
        + Quelque soit l’issu (succès ou erreur), fournir un message approprié à la view */

require_once __DIR__ . '/../model/ModelPlayer.php';
require_once __DIR__ . '/../view/ViewHome.php';
require_once __DIR__ . '/../controller/Controller.php';

class ControllerHome extends Controller{
    //ATTRIBUT
    private ModelPlayer $modelPlayer;
    private ViewHome $viewHome;

    //CONSTRUCTEUR
    public function __construct(ModelPlayer $modelPlayer, ViewHome $viewHome){
        $this->modelPlayer = $modelPlayer;
        $this->viewHome = $viewHome;
    }

    //GETTER ET SETTER
    /**
     * Get the value of modelPlayer
     *
     * @return ModelPlayer
     */
    public function getModelPlayer(): ModelPlayer {
        return $this->modelPlayer;
    }

    /**
     * Set the value of modelPlayer
     *
     * @param ModelPlayer $modelPlayer
     *
     * @return self
     */
    public function setModelPlayer(ModelPlayer $modelPlayer): self {
        $this->modelPlayer = $modelPlayer;
        return $this;
    }

    /**
     * Get the value of viewHome
     *
     * @return ViewHome
     */
    public function getViewHome(): ViewHome {
        return $this->viewHome;
    }

    /**
     * Set the value of viewHome
     *
     * @param ViewHome $viewHome
     *
     * @return self
     */
public function setViewHome(ViewHome $viewHome): self {
        $this->viewHome = $viewHome;
        return $this;
    }

    //METHOD
public function displayPlayers(){
        //1.Récupérer les données utilisateurs
        // -> appelle à findAll() du model et stocker les données retournés dans une variable
        $data = $this->modelPlayer->findAll();

        //2. Vérifier les data pour savoir si je reçois un tableau de donnée ou un message d'erreur
        switch(gettype($data)){
            case "string" :
                $this->viewHome->setMessage($data)->displayAll();
                break;
            case "array" :
                $this->viewHome->setData($data)->displayAll();
                break;
        }
    }

public function registerPlayer(): void {
    $pseudo = trim($_POST['pseudo'] ?? '');
    $score = filter_input(INPUT_POST, 'score', FILTER_VALIDATE_INT);
    $id_team = filter_input(INPUT_POST, 'id_team', FILTER_VALIDATE_INT);

    if ($pseudo === '' || $score === false || $score === null || $id_team === false || $id_team === null) 
        {$this->viewHome->setMessage("Veuillez remplir correctement tous les champs.");
        return;
    }

    // Vérifier le score et l'id
    if ($score < 0 || $id_team <= 0) {
        $this->viewHome->setMessage("Le score ou l'équipe est invalide.");
        return;
    }

    // Vérifier l'existance du pseudo
    $player = $this->modelPlayer->findByPseudo($pseudo);

    if (!empty($player)) {
        $this->viewHome->setMessage("Ce pseudo est déjà utilisé.");
        return;
    }

    // Enregistrer le joueur
    $result = $this->modelPlayer->add($pseudo, $score, $id_team);

    // Confirmer par message de l'enregistrement
    if ($result) {
        $this->viewHome->setMessage("Le joueur a été ajouté avec succès.");
    } else {
        $this->viewHome->setMessage("Erreur lors de l'ajout du joueur.");
    }
}



}
?>