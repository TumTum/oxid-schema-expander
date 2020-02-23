<?php

namespace spec\tm\oxid\SchemaExpander\Database\Key;

use tm\oxid\SchemaExpander\Database\Key;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PrimarySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('OXID');
        $this->shouldHaveType(Key\Primary::class);
        $this->shouldHaveType(Key::class);
        $this->getStm()->shouldBe('PRIMARY KEY (`OXID`)');
    }
}
