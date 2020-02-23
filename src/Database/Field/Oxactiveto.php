<?php

namespace tm\oxid\SchemaExpander\Database\Field;

use tm\oxid\SchemaExpander\Database\AlterFieldTrait;
use tm\oxid\SchemaExpander\Database\FieldInterface;

/**
 * Class Oxactiveto
 * @package tm\oxid\SchemaExpander\Database\Field
 */
class Oxactiveto implements FieldInterface
{
    use AlterFieldTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'OXACTIVETO';
    }

    /**
     * @return string
     */
    public function getAlterStm()
    {
        return "datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Active to specified date'";
    }
}
