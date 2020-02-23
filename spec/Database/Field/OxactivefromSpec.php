<?php

namespace spec\tm\oxid\SchemaExpander\Database\Field;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OxactivefromSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\Field\Oxactivefrom');
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\FieldInterface');
    }

    public function it_give_me_name()
    {
        $this->getName()->shouldBe('OXACTIVEFROM');
    }

    public function it_give_me_alter()
    {
        $this->getAlterStm()->shouldBe("datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Active from specified date'");
    }
}
