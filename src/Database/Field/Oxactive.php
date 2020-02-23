<?php

namespace tm\oxid\SchemaExpander\Database\Field;

use tm\oxid\SchemaExpander\Database\AlterFieldTrait;
use tm\oxid\SchemaExpander\Database\FieldInterface;

class Oxactive implements FieldInterface
{
    use AlterFieldTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'OXACTIVE';
    }

    /**
     * @return string
     */
    public function getAlterStm()
    {
        return "tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Active'";
    }
}
