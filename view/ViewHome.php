<?php

/*Dans le fichier ViewHome.php : créez la classe ViewHome.
- méthode displayMain() : effectue un echo de la partie HTML correspondant au <main>.
Son but est d’avoir un formulaire d’ajout de joueur (pseudo, score, et un menu déroulant 
pour les teams Chaque Option de ce Select associe un nom d’équipe de la base de données à la valeur de son id.
Pour les besoins de l’exercice, faite cela en dur dans le HTML, sans utiliser de requête à la BDD :
        + value : 1, affiche Aucune
        + value : 2, affiche TeamRocket
        + value : 3, affiche DreamTeam

Il y aura aussi un message de confirmation ou d’erreur pour ce formulaire.
De plus, ce <main> affiche aussi la liste de tous les joueurs (pseudo, score, team)

- méthode displayAll() : effectue le lancement de chaque display dans le bon ordre :
displayHeader(), displayMain(), displayFooter() */

require_once __DIR__ . '/../view/View.php';
class ViewHome extends View{
    //ATTRIBUT
    private string $message = "";
    private string $messageCo = "";
    private array $data = [];

    //GETTER ET SETTER
    /**
     * Get the value of message
     *
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message): self {
        $this->message = $message;
        return $this;
    }

    /**
     * Get the value of messageCo
     *
     * @return string
     */
    public function getMessageCo(): string {
        return $this->messageCo;
    }

    /**
     * Set the value of messageCo
     *
     * @param string $messageCo
     *
     * @return self
     */
    public function setMessageCo(string $messageCo): self {
        $this->messageCo = $messageCo;
        return $this;
    }

    /**
     * Get the value of data
     *
     * @return array
     */
    public function getData(): array {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param array $data
     *
     * @return self
     */
    public function setData(array $data): self {
        $this->data = $data;
        return $this;
    }

    //METHODS
    function displayMain():void{
    ?>
        <main>
                <h1>Page d'Accueil</h1>
                
                        <section>
                            <h2>Ajout de joueur</h2>
                            <form action="" method="post">
                                <label for="pseudo">pseudo <input type="text" name="pseudo" id="pseudo"></label>
                                <label for="score">score <input type="number" name="score" id="score"></label>
                                <label for="id_team">id_team
                                    <select name="id_team" id="id_team">
                                        <option value=""></option>
                                        <option value="1">Aucune</option>
                                        <option value="2">TeamRocket</option>
                                        <option value="3">DreamTeam</option>
                                    </select></label>
                                <input type="submit" name="submit">
                            </form>
                            <p>
                                <?php echo(htmlentities($this->getMessage())) ?>
                            </p>
                        </section>
                <section>
                    <h2>Listes des joueurs</h2>
                    <ul>
                        <?php 
                            foreach($this->getData() as $player){
                                //Affichage en nettoyant les données provenant de la BDD
                                echo("<li>".htmlentities($player['pseudo'])." ".htmlentities($player['score'])." - ".htmlentities($player['team'])."</li>");
                            } 
                        ?>
                    </ul>
                </section>
        </main>
    <?php
    }
  public function displayAll()
    {
        $this->displayHeader();
        $this->displayMain();
        $this->displayFooter();
    }
}
?>