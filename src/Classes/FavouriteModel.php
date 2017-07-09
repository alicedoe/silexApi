<?php

namespace Models\Classes;

use Doctrine\DBAL\Connection;
use \PDO;

class FavouriteModel
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
     * Return a list of all favourite related to an user_id.
     * @param number $id
     * @return array A list of favourite.
     */
    public function getAll($id) {
        $sql = $this->pdo->prepare("SELECT * FROM favourite WHERE id_user=:id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        $rows = $sql->fetchAll();
        $sql->closeCursor();
        $sql = NULL;
        return $rows;
    }

    /**
     * Return a list of all company favourite related to an user_id.
     * @param number $id
     * @return array A list of favourite.
     */
    public function getCompanyFavourite($id) {
        $sql = $this->pdo->prepare("SELECT * FROM favourite WHERE id_user=:id and id_company!= 0");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        $rows = $sql->fetchAll();
        $sql->closeCursor();
        $sql = NULL;
        return $rows;
    }

    /**
     * Return a list of all product favourite related to an user_id.
     * @param number $id
     * @return array A list of favourite.
     */
    public function getProductFavourite($id) {
        $sql = $this->pdo->prepare("SELECT * FROM favourite WHERE id_user=:id and id_produits!= 0");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        $rows = $sql->fetchAll();
        $sql->closeCursor();
        $sql = NULL;
        return $rows;
    }

}
