<?php

namespace tm\oxid\SchemaExpander;

use tm\oxid\SchemaExpander\Database;

class DesireExpander
{
    /**
     * @var ExtendTables
     */
    private $tables;

    /**
     * DesireExpander constructor.
     */
    public function __construct(ExtendTables $extendTables = null)
    {
        if ($extendTables === null) {
            $extendTables = new ExtendTables(new Database\OxidDB());
        }

        $this->tables = $extendTables;
    }

    /**
     * @param $name
     *
     * @return Database\Table
     */
    public function table($name)
    {
        $table = new Database\Table($name);

        $this->tables->addTable($table);

        return $table;
    }

    /**
     * The tables will be reviewed and extended or created if necessary.
     */
    public function execute()
    {
        $this->tables->execute();
    }
}
