<?php

namespace Models\Classes;

use Doctrine\DBAL\Connection;
use \PDO;

class ContributionModel
{

    private $pdo;

    public function __construct(Connection $db)
    {

        try
        {
            $this->pdo = new PDO('mysql:host=localhost;dbname=circus;charset=utf8', 'root', 'root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /**
     * Return a list of all contributions.
     *
     * @return array A list of all contributions.
     */
    public function getAll() {

        $sql = $this->pdo->prepare("SELECT * FROM contribution");
        $sql->execute();
        $rows = $sql->fetchAll();
        $sql->closeCursor();
        $sql = NULL;

        return $rows;
    }

    /**
     * Récupère les idées contributions ajoutés par un utilisateur
     *
     * @param number $id
     *
     * @return array $result
     */
    function ideeFromContri($id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE id =:id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        $user = $sql->fetchAll();

        $sql = $this->pdo->prepare("SELECT * FROM contribution WHERE contributeur =:name AND type = 'idee' ORDER BY id DESC");
        $sql->bindValue(":name", $user[0]['username'], PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetchAll();

        $sql->closeCursor();
        $sql = NULL;
        return $result;

    }

    /**
     * Récupère les contributions d'une categorie
     *
     * @param string $categorie
     *
     * @return array $result
     */
    function contributionCategorie($categorie)
    {
        $sql = $this->pdo->prepare("SELECT * FROM contribution WHERE categorie =:categorie");
        $sql->bindValue(":categorie", $categorie, PDO::PARAM_STR);
        $sql->execute();
        $contribution = $sql->fetchAll();
        $sql->closeCursor();
        $sql = NULL;

        return $contribution;

    }

    /**
     * Récupère les contributions idee from the current user with reference $ref in JSON format
     *
     * @param string $ref
     * @param number $id
     *
     * @return array $result
     */
    function IdeeContriRef($ref,$id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE id =:id");
        $sql->bindValue(":id", $id, PDO::PARAM_STR);
        $sql->execute();
        $users = $sql->fetchAll();

        $sql = $this->pdo->prepare("SELECT * FROM contribution WHERE contributeur =:contributeur AND type = 'idee' AND reference =:ref");
        $sql->bindValue(":contributeur", $users[0]['username'], PDO::PARAM_STR);
        $sql->bindValue(":ref", $ref, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetchAll();
        $sql->closeCursor();
        $sql = NULL;

        return $result;

    }
}