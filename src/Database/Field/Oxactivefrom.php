<?php

namespace tm\oxid\SchemaExpander\Database\Field;

use tm\oxid\SchemaExpander\Database\AlterFieldTrait;
use tm\oxid\SchemaExpander\Database\FieldInterface;

/**
 * Class Oxactivefrom
 * @package tm\oxid\SchemaExpander\Database\Field
 */
class Oxactivefrom implements FieldInterface
{
    use AlterFieldTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'OXACTIVEFROM';
    }

    /**
     * @return string
     */
    public function getAlterStm()
    {
        return 'datetime NOT NULL DEFAULT \'0000-00-00 00:00:00\' COMMENT \'Active from specified date\'';
    }
}
