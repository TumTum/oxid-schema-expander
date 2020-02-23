<?php

namespace spec\tm\oxid\SchemaExpander\Database\Field;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OxlangSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\Field\Oxlang');
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\FieldInterface');
    }

    public function it_give_me_name()
    {
        $this->getName()->shouldBe('OXLANG');
    }

    public function it_give_me_alter()
    {
        $this->getAlterStm()->shouldContain("int(2) NOT NULL DEFAULT '0' COMMENT 'Language id'");
    }
}
