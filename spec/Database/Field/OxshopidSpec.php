<?php

namespace spec\tm\oxid\SchemaExpander\Database\Field;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OxshopidSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\Field\Oxshopid');
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\FieldInterface');
    }

    public function it_give_me_name()
    {
        $this->getName()->shouldBe('OXSHOPID');
    }

    public function it_give_me_alter()
    {
        $this->getAlterStm()->shouldContain("COMMENT 'Shop id (oxshops)'");
    }
}
