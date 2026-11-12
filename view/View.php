<?php

/*Dans le fichier View.php : créez la classe View. Elle possède les méthodes :
- displayHeader() : effectue un echo de la partie HTML correspondant au header de la page 
(balise DOCTYPE jusqu’à la balise de fermeture header), puis retourne l’objet $this.

- displayFooter() : effectue un echo de la partie correspondant au footer de la page
 (balise ouvrante footer jusqu’à la balise de fermeture html), puis retourne l’objet $this. 
*/

class View{
    //ATTRIBUT
    private string $title = "";

    //SETTER ET GETTER
    public function getTitle():string{
        return $this->title;
    }
    public function setTitle(string $newTitle):self{
        $this->title = $newTitle;
        return $this;
    }

    //METHODS
    // Header

    public function displayHeader():self{

    ?>

        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo($this->getTitle()) ?></title>
        </head>
        <body>
            <header>
            </header>
    <?php
    return $this;
    }


    // Footer
    public function displayFooter():self{
    ?>
        <footer>
        </footer>
        </body>
        </html>
        
    <?php
    return $this;
    }
}
?>