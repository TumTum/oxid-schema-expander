<?php

namespace tm\oxid\SchemaExpander\Database;

interface FieldInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getAlterStm();

    /**
     * @return mixed
     */
    public function getAfterFieldname();

    /**
     * @return mixed
     */
    public function setAfterFieldname($afterfieldname);
}
