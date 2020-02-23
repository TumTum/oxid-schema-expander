<?php

namespace tm\oxid\SchemaExpander\Database\Key;

use tm\oxid\SchemaExpander\Database\Key;

class Primary extends Key
{
    /**
     * Key constructor.
     *
     * @param string $name
     * @param null|string|array $fields
     */
    public function __construct($name, $fields = null)
    {
        parent::__construct($name, $fields);
        $this->setType(Key::PRIMARY);
    }

}
