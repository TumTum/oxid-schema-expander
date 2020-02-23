<?php

namespace spec\tm\oxid\SchemaExpander\Database\Field;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OxactiveSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\Field\Oxactive');
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\FieldInterface');
    }

    public function it_give_me_name()
    {
        $this->getName()->shouldBe('OXACTIVE');
    }

    public function it_give_me_alter()
    {
        $this->getAlterStm()->shouldBe("tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Active'");
    }
}
