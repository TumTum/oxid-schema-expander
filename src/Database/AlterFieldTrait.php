<?php

namespace tm\oxid\SchemaExpander\Database;

/**
 * Trait AlterFieldTrait
 *
 * @package tm\oxid\SchemaExpander\Database
 */
trait AlterFieldTrait
{
    /**
     * @var string
     */
    protected $afterfieldname = '';

    /**
     * @param string $afterfieldname
     */
    public function setAfterFieldname($afterfieldname)
    {
        $this->afterfieldname = $afterfieldname;
    }

    /**
     * @return string
     */
    public function getAfterFieldname()
    {
        return $this->afterfieldname;
    }
}
