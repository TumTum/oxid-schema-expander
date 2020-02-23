<?php

namespace tm\oxid\SchemaExpander\Database;

interface ConnectorInterface
{
    /**
     * @param $sql_stm
     * @return array
     */
    public function getAll($sql_stm);

    /**
     * @param $sql_stm
     * @return mixed
     */
    public function execute($sql_stm);
}
