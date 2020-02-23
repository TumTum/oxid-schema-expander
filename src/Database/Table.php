<?php

namespace tm\oxid\SchemaExpander\Database;

/**
 * Class Table
 *
 * @package tm\oxid\SchemaExpander\Database
 */
class Table implements TableInterface
{
    /**
     * @var array
     */
    protected $keys = [];

    /**
     * @var string
     */
    protected $tablename = '';

    /**
     * @var array
     */
    protected $field = [];

    /**
     * Table constructor.
     * @param $tablename
     */
    public function __construct($tablename)
    {
        $this->tablename = $tablename;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tablename;
    }

    /**
     *
     * @param $name
     * @param $alterstm
     * @param $afterfieldname
     * @return $this
     */
    public function addField($name, $alterstm, $afterfieldname = '')
    {
        $this->field[] = new Field($name, $alterstm, $afterfieldname);
        if ($afterfieldname == '') {
            $this->compileAlterPostion();
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->field;
    }

    /**
     * @param $name
     * @param string|array $field
     * @return $this
     */
    public function addKey($name, $field = null)
    {
        $index = new Key\Index($name, $field);
        $this->keys[] = $index->getStm();

        return $this;
    }

    /**
     * @param $name
     * @param string|array $field
     *
     * @return $this
     */
    public function addUniqueKey($name, $field = null)
    {
        $unique = new Key\Unique($name, $field);
        $this->keys[] = $unique->getStm();

        return $this;
    }

    /**
     * @param string|array $field
     */
    public function setPrimaryKey($field)
    {
        $primary = new Key\Primary('', $field);

        $this->keys[0] = $primary->getStm();

        return $this;
    }

    /**
     * @return bool
     */
    public function hasKeys()
    {
        return count($this->keys) > 0;
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * @return $this
     */
    public function addFieldOxid()
    {
        $this->field[] = new Field\Oxid();
        $this->compileAlterPostion();
        return $this;
    }

    /**
     * @return $this
     */
    public function addFieldOxtimestamp()
    {
        $this->field[] = new Field\Oxtimestamp();
        $this->compileAlterPostion();
        return $this;
    }

    /**
     * @return $this
     */
    public function addFieldOxshopid()
    {
        $this->field[] = new Field\Oxshopid();
        $this->compileAlterPostion();
        return $this;
    }

    /**
     * @return $this
     */
    public function addFieldOxactive()
    {
        $this->field[] = new Field\Oxactive();
        $this->compileAlterPostion();
        return $this;
    }

    /**
     * @return $this
     */
    public function addFieldOxactiveFrom()
    {
        $this->field[] = new Field\Oxactivefrom();
        $this->compileAlterPostion();
        return $this;
    }

    /**
     * @return $this
     */
    public function addFieldOxactiveTo()
    {
        $this->field[] = new Field\Oxactiveto();
        $this->compileAlterPostion();
        return $this;
    }

    /**
     * @return $this
     */
    public function addFieldOxlang()
    {
        $this->field[] = new Field\Oxlang();
        $this->compileAlterPostion();
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function after($column)
    {
        $count = count($this->field);

        if ($count == 0) {
            throw new \LogicException("Add first a field, then call ->alter('$column')");
        }

        /** @var FieldInterface $field */
        $field = $this->field[$count - 1];
        $field->setAfterFieldname($column);

        return $this;
    }

    protected function compileAlterPostion()
    {
        $count = count($this->field);
        if ($count < 2) {
            return;
        }
        /** @var FieldInterface $fieldBefore */
        $fieldBefore = $this->field[$count - 2];
        /** @var FieldInterface $fieldLast */
        $fieldLast = $this->field[$count - 1];

        $fieldLast->setAfterFieldname($fieldBefore->getName());
    }
}
