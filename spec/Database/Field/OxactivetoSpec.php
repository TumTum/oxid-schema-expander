<?php

namespace spec\tm\oxid\SchemaExpander\Database\Field;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OxactivetoSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\Field\Oxactiveto');
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\FieldInterface');
    }

    public function it_give_me_name()
    {
        $this->getName()->shouldBe('OXACTIVETO');
    }

    public function it_give_me_alter()
    {
        $this->getAlterStm()->shouldContain("datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Active to specified date'");
    }
}
