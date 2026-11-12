
<?php
/*Le fichier index.php sert de point d’entrée.
 Il va donc exécuter le code comme suit :
- Créer un objet controllerHome en lui fournissant un ModelPlayer et un ViewHome
- Lancer registerPlayer()
- Lancer displayPlayers()
- Lancer render() */

include './utils/Utils.php';
include './model/Model.php';
include './model/ModelPlayer.php';
include './view/View.php';
include './view/viewHome.php';
include './controller/Controller.php';
include './controller/ControllerHome.php';

// Création un objet controllerHome
$modelPlayer = new ModelPlayer();
$viewHome = new ViewHome();
$controllerHome = new ControllerHome($modelPlayer, $viewHome);

// Lancer registerPlayer() + displayPlayers() +render()
$controllerHome->registerPlayer();

$controllerHome->displayPlayers();

$controllerHome->render();

?>
