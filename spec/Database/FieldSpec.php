<?php

namespace spec\tm\oxid\SchemaExpander\Database;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class FieldSpec
 *
 * @package spec\tm\oxid\SchemaExpander\Database
 */
class FieldSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('fieldname', 'INI(10)');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\Field');
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\FieldInterface');
    }

    public function it_can_give_me_my_name()
    {
        $this->getName()->shouldBe('fieldname');
    }

    public function it_can_give_me_the_alter_stm()
    {
        $this->getAlterStm()->shouldBe('INI(10)');
    }
}
