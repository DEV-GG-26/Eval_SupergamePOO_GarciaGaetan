<?php
/*Dans le fichier Controller.php, créez la class Controller. 

1)Son constructeur prend en paramètre un objet Model pour l’attribuer à sa propriété model, 
ainsi qu’un objet View pour l’attribuer à sa propriété view.

2)De plus, elle possède une méthode :
- render() : appelle la view et lui demande de lancer sa méthode displayAll(). */

require_once __DIR__ . '/../model/Model.php';
require_once __DIR__ . '/../view/View.php';
class Controller{
    //ATTRIBUT
    private array $models = [];
    private array $views = [];

    //CONSTRUCTEUR : laisser vide, car c'est controller concret qui sait comment il doit se construire

    //GETTER ET SETTER
    /**
     * Get the value of models
     *
     * @return array
     */
    public function getModels(): array {
        return $this->models;
    }

    /**
     * Set the value of models
     *
     * @param array $models
     *
     * @return self
     */
    public function setModels(array $models): self {
        $this->models = $models;
        return $this;
    }

    /**
     * Get the value of views
     *
     * @return array
     */
    public function getViews(): array {
        return $this->views;
    }

    /**
     * Set the value of views
     *
     * @param array $views
     *
     * @return self
     */
    public function setViews(array $views): self {
        $this->views = $views;
        return $this;
    }

    //METHODS pour ajouter et retire un élément des attribut tableau
    public function addModel(string $key, Model $newModel):self{
        $this->models[$key] = $newModel;
        return $this;
    }
    public function removeModel(string $key):self{
        unset($this->models[$key]);
        return $this;

    }

    public function addView(string $key, View $newView):self{
        $this->views[$key] = $newView;
        return $this;
    }
    public function removeView(string $key):self{
        unset($this->views[$key]);
        return $this;

    }

    //METHODS
    // header, le contenu principal et le footer
    public function render():void{
        if(array_key_exists("header",$this->getViews())){
            $this->getViews()["header"]->display();
        }
        if(array_key_exists("main",$this->getViews())){
            $this->getViews()["main"]->display();
        }
        if(array_key_exists("footer",$this->getViews())){
            $this->getViews()["footer"]->display();
        } 
    }
}
?>