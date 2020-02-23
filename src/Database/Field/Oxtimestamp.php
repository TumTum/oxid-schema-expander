<?php

namespace tm\oxid\SchemaExpander\Database\Field;

use tm\oxid\SchemaExpander\Database\AlterFieldTrait;
use tm\oxid\SchemaExpander\Database\FieldInterface;

class Oxtimestamp implements FieldInterface
{
    use AlterFieldTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'OXTIMESTAMP';
    }

    /**
     * @return string
     */
    public function getAlterStm()
    {
        return 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
    }
}
