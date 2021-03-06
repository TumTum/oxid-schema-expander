<?php

namespace tm\oxid\SchemaExpander;

use tm\oxid\SchemaExpander\Database\ConnectorInterface;
use tm\oxid\SchemaExpander\Database\FieldInterface;
use tm\oxid\SchemaExpander\Database\TableInterface;

class ExtendTables
{
    const table_doesn_not_exist = 1146;

    /**
     * @var ConnectorInterface
     */
    protected $db = null;

    /**
     * @var array
     */
    protected $tables = [];

    /**
     * ExtendTable constructor.
     *
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $db)
    {
        $this->db = $db;
    }

    /**
     * @param array $tabels
     * @return $this
     */
    public function addTables(array $tabels)
    {
        foreach ($tabels as $table) {
            $this->addTable($table);
        }

        return $this;
    }

    /**
     * @param TableInterface $table
     * @return $this
     */
    public function addTable(TableInterface $table)
    {
        $this->tables[] = $table;

        return $this;
    }

    /**
     *
     */
    public function execute()
    {
        array_walk($this->tables, [$this, 'migration']);
    }

    /**
     *
     */
    protected function migration(TableInterface $sTable)
    {
        try {
            $this->extendTable($sTable);
        } catch (\Exception $exception) {
            if ($exception->getCode() === self::table_doesn_not_exist) {
                $this->createTable($sTable);
            } else {
                throw $exception;
            }
        }
    }

    /**
     * @param TableInterface $table
     */
    protected function extendTable(TableInterface $table)
    {
        $actuallyColumns = $this->getColumnsFrom($table->getTableName());

        /** @var FieldInterface $Column */
        foreach ($table->getFields() as $Column) {

            $columnName = strtoupper($Column->getName());
            if (in_array($columnName, $actuallyColumns) === false) {

                $sAfterStm = $this->checkCanBeAlter($Column, $actuallyColumns);

                $sAlterSQL = sprintf(
                    'ALTER TABLE `%s` ADD COLUMN `%s` %s %s',
                    $table->getTableName(),
                    $columnName,
                    $Column->getAlterStm(),
                    $sAfterStm
                );

                $this->db->execute($sAlterSQL);
                $actuallyColumns[] = $columnName;
            }
        }
    }

    /**
     * @param $oField
     * @param $actuallyColumns
     * @return string
     */
    protected function checkCanBeAlter($oField, $actuallyColumns)
    {
        $sAfterStm = "";

        $sAfterFieldname = strtoupper($oField->getAfterFieldname());
        if ($sAfterFieldname && in_array($sAfterFieldname, $actuallyColumns)) {
            $sAfterStm = "AFTER `{$sAfterFieldname}`";
        }

        return $sAfterStm;
    }

    protected function createTable(TableInterface $sTable)
    {
        $definition = [];

        /** @var FieldInterface $oField */
        foreach ($sTable->getFields() as $oField) {
            $definition[] = sprintf('`%s` %s', strtoupper($oField->getName()), $oField->getAlterStm());
        }

        $createTable = sprintf('CREATE TABLE `%s` (%s) ENGINE=InnoDB', $sTable->getTableName(), join(', ', $definition));

        $this->db->execute($createTable);

        if ($sTable->hasKeys()) {
            $this->addTableKeys($sTable);
        }
    }

    /**
     * @param TableInterface $sTable
     */
    protected function addTableKeys(TableInterface $sTable)
    {
        foreach ($sTable->getKeys() as $key) {
            $alter = sprintf('ALTER TABLE `%s` ADD %s', $sTable->getTableName(), $key);
            $this->db->execute($alter);
        }
    }

    /**
     * @param string $tablename
     * @return array
     */
    protected function getColumnsFrom($tablename)
    {
        $stm = 'SHOW COLUMNS FROM ' . $tablename;

        $aDbColsRaw = $this->db->getAll($stm);

        return array_map(function ($row) {
            if (!isset($row['Field'])) {
                throw new \Exception("SQL Statement failed: Row has not 'Field'-Key: " . var_export($row, true));
            }

            return strtoupper($row['Field']);
        }, $aDbColsRaw);
    }
}
