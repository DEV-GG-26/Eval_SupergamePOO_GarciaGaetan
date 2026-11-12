<?php
/*Dans le fichier ModelPlayer.php, créez la classe ModelPlayer.

 1)Elle possède des méthodes qui envoie des requêtes à la BDD au sein de Try…Catch.
  
 Dans chaque cas, le Catch attrape l’exception et affiche le message d’erreur grâce à die() :
2)- findAll() : requête pour récupérer tous les players avec toutes leurs informations 
(id, pseudo, score, team). Elle retourne un tableau contenant des tableaux associatifs.

3)- findByPseudo() : requête pour récupérer qu’un seul player grâce à son pseudo. 
Elle retourne un tableau associatif.

4)- add() : requête pour enregistrer un player en connaissant son pseudo,
 son score et l’id de sa team (la clé étrangère id_team).

5)- delete() : requête pour supprimer un player en connaissant son id.

6)- update() requête pour mettre à jour les données d’un player existant grâce à son id, 
en connaissant son pseudo, son score et l’id de sa team (la clé étrangère id_team). */


require_once __DIR__ . '/../model/Model.php';
class ModelPlayer extends Model {

    // METHODES

    // récupérer tous les players

    function findAll(): array{
        try{
            $request = $this->getPdo()->prepare('SELECT p.id_player, p.pseudo, p.score, t.team FROM player p INNER JOIN team t ON p.id_team = t.id_team');
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){
            die($error->getMessage());
        }
    }   

    // récupérer qu’un seul player
    public function findByPseudo(string $pseudo): array | false {
    try {
        $request = $this->getPdo()->prepare('SELECT p.id_player, p.pseudo, p.score, t.team FROM player p INNER JOIN team t ON p.id_team = t.id_team
                WHERE p.pseudo = :pseudo');
        $request->execute(['pseudo' => $pseudo]);
        return $request->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $error) {
        die($error->getMessage());
    }
}

    // Ajouter un joueur
    public function add(string $pseudo, int $score, int $id_team): bool {
        try {
            $request = $this->getPdo()->prepare('INSERT INTO player (pseudo, score, id_team)
                    VALUES (:pseudo, :score, :id_team)');
            return $request->execute([':pseudo' => $pseudo,':score' => $score,':id_team' => $id_team]);
        } catch (Exception $error) {
            die("Erreur add : " . htmlentities($error->getMessage()));
        }
    }

    // supprimer un joueur
    public function delete(int $id): bool {
        try {
            $request = $this->getPdo()->prepare('DELETE FROM player WHERE id_player = :id');
            return $request->execute([':id' => $id ]);
        } catch (Exception $error) {
            die("Erreur delete : " . htmlentities($error->getMessage()));
        }
    }


    // Modifier un joueur 
    public function update(int $id, string $pseudo, int $score, int $id_team): bool {
        try {
            $request = $this->getPdo()->prepare('UPDATE player SET pseudo = :pseudo, score = :score, id_team = :id_team
                    WHERE id_player = :id")
                    VALUES (:pseudo, :score, :id_team)');
            return $request->execute([':pseudo' => $pseudo,':score' => $score,':id_team' => $id_team,':id' => $id]);
        } catch (Exception $error) {
            die("Erreur update : " . htmlentities($error->getMessage()));
        }
    }
}

?>