<?php

namespace tm\oxid\SchemaExpander\Database;

class Key
{
    const PRIMARY = 1;
    const UNIQUE = 3;
    const INDEX = 0;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $fields;

    /**
     * @var integer
     */
    protected $type = 0;

    /**
     * Key constructor.
     *
     * @param string $name
     * @param null|string|array $fields
     */
    public function __construct($name, $fields = null)
    {
        $this->name = strtoupper($name);

        $this->setFields($name, $fields);
    }

    /**
     * @return string
     */
    public function getStm()
    {
        switch ($this->type) {
            case self::PRIMARY:
                return sprintf('PRIMARY KEY (%s)', implode(', ', $this->fields));
            case self::INDEX:
                return sprintf('KEY `%s` (%s)', $this->name, implode(', ', $this->fields));
            case self::UNIQUE:
                return sprintf('UNIQUE KEY `%s` (%s)', $this->name, implode(', ', $this->fields));
        }
    }

    /**
     * @param integer $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param $name
     * @param $fields
     */
    protected function setFields($name, $fields)
    {
        if ($fields === null) {
            $fields = [$name];
        }

        if (is_string($fields)) {
            $fields = [$fields];
        }

        $this->fields = array_map([$this, 'convertKey'], $fields);
    }

    /**
     * @param string|array $field Wenn es ein Array ist die Länge des Feld wichtig
     * @return string
     */
    protected function convertKey($field)
    {
        if (is_array($field)) {
            return sprintf('`%s`(%s)', strtoupper($field[0]), $field[1]);
        }
        return $this->quote(strtoupper($field));
    }

    /**
     * @param $str
     * @return string
     */
    protected function quote($str)
    {
        return "`{$str}`";
    }
}
