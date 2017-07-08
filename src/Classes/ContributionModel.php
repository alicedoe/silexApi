<?php

namespace Models\Classes;

use Doctrine\DBAL\Connection;

class ContributionModel
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
    public function __construct(Connection $db)
    {
        $this->db = $db;
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
}