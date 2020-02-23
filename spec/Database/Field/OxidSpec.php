<?php

namespace spec\tm\oxid\SchemaExpander\Database\Field;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OxidSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\Field\Oxid');
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\FieldInterface');
    }

    public function it_give_me_name()
    {
        $this->getName()->shouldBe('OXID');
    }

    public function it_give_me_alter()
    {
        $this->getAlterStm()->shouldBe('char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL');
    }
}
