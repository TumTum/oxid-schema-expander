<?php

namespace tm\oxid\SchemaExpander\Database;

use OxidEsales\Eshop\Core\DatabaseProvider;

/**
 * Class OxidDB
 *
 * @package tm\oxid\SchemaExpander\Database
 */
class OxidDB implements ConnectorInterface
{
    /**
     * @var \DatabaseInterface
     */
    protected $db;

    /**
     * OxidDB constructor.
     */
    public function __construct()
    {
        $this->db = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
    }

    /**
     * @param $sql_stm
     */
    public function getAll($sql_stm)
    {
        return $this->db->getAll($sql_stm);
    }

    /**
     * @param $sql_stm
     */
    public function execute($sql_stm)
    {
        return $this->db->execute($sql_stm);
    }
}
