<?php

namespace Models\Tables;

use Doctrine\DBAL\Connection;

class ContributionTable
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

}