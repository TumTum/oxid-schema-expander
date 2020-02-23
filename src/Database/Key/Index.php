<?php

namespace tm\oxid\SchemaExpander\Database\Key;

use tm\oxid\SchemaExpander\Database\Key;

class Index extends Key
{
    /**
     * Key constructor.
     *
     * @param string $name
     * @param null|string|array $fields
     */
    public function __construct($name, $fields = null)
    {
        $this->setType(Key::INDEX);
        parent::__construct($name, $fields);
    }

}
