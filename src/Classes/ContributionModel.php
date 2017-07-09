<?php

namespace Models\Classes;

use Doctrine\DBAL\Connection;
use \PDO;

class ContributionModel
{
    /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;
    private $pdo;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;

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
        $sql = "select * from contribution";
        $result = $this->db->fetchAll($sql);

        return $result;
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
        $sql = "SELECT * FROM users WHERE id = $id";
        $user = $this->db->fetchAll($sql);

        $query = "SELECT * FROM contribution WHERE contributeur = '" . $user[0]['username'] . "' AND type = 'idee' ORDER BY id DESC";
        $result = $this->db->fetchAll($query);

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
        $sql = "SELECT * FROM contribution WHERE categorie = '".$categorie."'";
        $contrib = $this->db->fetchAll($sql);

        return $contrib;

    }

    /**
     * Vérifie si le token envoyé autorise l'accès aux données de l'user id
     *
     * @param string $token
     * @param string $id
     *
     * @return boolean
     */
    function contributionTokenOk($token,$id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM circus_api_token WHERE users_id =:id");
        $sql->bindValue(":id", $id, PDO::PARAM_STR);
        $sql->execute();
        $rows = $sql->fetchAll();
        $sql->closeCursor();
        $sql = NULL;

        if ($rows[0]['token'] == $token) {
            return true;
        } else {
            return false;
        }

    }
}