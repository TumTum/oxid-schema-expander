<?php

namespace tm\oxid\SchemaExpander\Database\Field;

use tm\oxid\SchemaExpander\Database\AlterFieldTrait;
use tm\oxid\SchemaExpander\Database\FieldInterface;

/**
 * Class Oxid
 * @package tm\oxid\SchemaExpander\Database\Field
 */
class Oxid implements FieldInterface
{
    use AlterFieldTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'OXID';
    }

    /**
     * @return string
     */
    public function getAlterStm()
    {
        return 'char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL';
    }
}
