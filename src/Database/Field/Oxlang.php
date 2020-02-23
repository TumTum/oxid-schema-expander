<?php

namespace tm\oxid\SchemaExpander\Database\Field;

use tm\oxid\SchemaExpander\Database\AlterFieldTrait;
use tm\oxid\SchemaExpander\Database\FieldInterface;

/**
 * Class Oxlang
 * @package tm\oxid\SchemaExpander\Database\Field
 */
class Oxlang implements FieldInterface
{
    use AlterFieldTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return "OXLANG";
    }

    /**
     * @return string
     */
    public function getAlterStm()
    {
        return "int(2) NOT NULL DEFAULT '0' COMMENT 'Language id'";
    }
}
