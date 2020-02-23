<?php

namespace tm\oxid\SchemaExpander\Database\Field;

use tm\oxid\SchemaExpander\Database\AlterFieldTrait;
use tm\oxid\SchemaExpander\Database\FieldInterface;

class Oxshopid implements FieldInterface
{
    use AlterFieldTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'OXSHOPID';
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getAlterStm()
    {
        return "int(11) NOT NULL DEFAULT '1' COMMENT 'Shop id (oxshops)'";
    }

}
