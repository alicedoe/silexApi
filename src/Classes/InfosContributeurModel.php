<?php

namespace Models\Classes;

use Doctrine\DBAL\Connection;
use \PDO;

class InfosContributeurModel
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
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function userWithCoord() {
        $sql = "select * from infos_contributeur where lat != 0 and lng != 0";
        $result = $this->db->fetchAll($sql);

        return $result;
    }

    /**
     * Return a list of all infos_contributeur.
     *
     * @return array A list of all infos_contributeur.
     */
    public function getAll() {
        $sql = "select * from infos_contributeur";
        $result = $this->db->fetchAll($sql);

        return $result;
    }

    /**
     * Return one user from infos_contributeur with user_id=$id and activation set to 'oui'
     *
     * @return array with one user.
     */
    public function getUserActivated($id) {
        $sql = "select * from infos_contributeur where id_user = $id and activation='oui'";
        $result = $this->db->fetchAll($sql);

        return $result;
    }

    /**
     * Return one user from infos_contributeur with user_id=$id
     *
     * @return array with one user.
     */
    public function getUser($id) {
        $sql = "select * from infos_contributeur where id_user = $id";
        $result = $this->db->fetchAll($sql);

        return $result;
    }
}
