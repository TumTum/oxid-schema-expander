<?php

namespace spec\tm\oxid\SchemaExpander\Database\Key;

use tm\oxid\SchemaExpander\Database\Key;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IndexSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('EInFACH', ['FieldA', 'FieldB']);
        $this->shouldHaveType(Key\Index::class);
        $this->shouldHaveType(Key::class);
        $this->getStm()->shouldBe('KEY `EINFACH` (`FIELDA`, `FIELDB`)');
    }
}
