<?php

namespace spec\tm\oxid\SchemaExpander\Database\Key;

use tm\oxid\SchemaExpander\Database\Key;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UniqueSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('EInFACH', 'FieldA');
        $this->shouldHaveType(Key\Unique::class);
        $this->shouldHaveType(Key::class);
        $this->getStm()->shouldBe('UNIQUE KEY `EINFACH` (`FIELDA`)');
    }
}
