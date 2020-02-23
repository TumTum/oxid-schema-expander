<?php

namespace tm\oxid\SchemaExpander\Database;

/**
 * Class Field
 * @package tm\oxid\SchemaExpander\Database
 */
class Field implements FieldInterface
{
    use AlterFieldTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $alterstm;

    /**
     * Field constructor.
     *
     * @param string $name
     * @param string $alterstm
     * @param string $afterfieldname
     */
    public function __construct($name, $alterstm, $afterfieldname='')
    {
        $this->name     = $name;
        $this->alterstm = $alterstm;
        $this->afterfieldname = $afterfieldname;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAlterStm()
    {
        return $this->alterstm;
    }
}
