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
     * @param $sql_stm
     * @return array
     */
    public function getAll($sql_stm)
    {
        return DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->getAll($sql_stm);
    }

    /**
     * @param $sql_stm
     * @return int|mixed
     */
    public function execute($sql_stm)
    {
        return DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->execute($sql_stm);
    }
}
