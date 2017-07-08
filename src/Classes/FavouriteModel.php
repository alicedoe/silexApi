<?php

namespace Models\Classes;

use Doctrine\DBAL\Connection;

class FavouriteModel
{
    /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
    public function __construct(Connection $db) {
        $this->db = $db;
    }

    /**
     * Return a list of all favourite related to an user_id.
     * @param number $id
     * @return array A list of favourite.
     */
    public function getAll($id) {
        $sql = "select * from favourite where id_user=$id";
        $result = $this->db->fetchAll($sql);
        return $result;
    }

    /**
     * Return a list of all company favourite related to an user_id.
     * @param number $id
     * @return array A list of favourite.
     */
    public function getCompanyFavourite($id) {
        $sql = "select * from favourite where id_user=$id and id_company!= 0";
        $result = $this->db->fetchAll($sql);
        return $result;
    }

    /**
     * Return a list of all product favourite related to an user_id.
     * @param number $id
     * @return array A list of favourite.
     */
    public function getProductFavourite($id) {
        $sql = "select * from favourite where id_user=$id and id_produits!= 0";
        $result = $this->db->fetchAll($sql);
        return $result;
    }

}
