<?php

namespace tm\oxid\SchemaExpander\Database;

interface TableInterface
{

    /**
     * @return array
     */
    public function getFields();

    /**
     * @return string
     */
    public function getTableName();

    /**
     * @return bool
     */
    public function hasKeys();

    /**
     * @param string|array $field
     */
    public function setPrimaryKey($field);

    /**
     * @return array
     */
    public function getKeys();
}
