<?php

namespace spec\tm\oxid\SchemaExpander\Database;

use tm\oxid\SchemaExpander\Database\Key;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KeySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->beConstructedWith('name', 'field');
        $this->shouldHaveType(Key::class);
    }

    public function it_can_set_key_name_and_field()
    {
        $this->beConstructedWith('name', 'field');
        $this->getStm()->shouldBe('KEY `NAME` (`FIELD`)');
    }

    public function it_can_set_key_more_fields()
    {
        $this->beConstructedWith('name', ['field_a', 'field_b']);
        $this->getStm()->shouldBe('KEY `NAME` (`FIELD_A`, `FIELD_B`)');
    }

    public function it_can_set_key_with_field_length()
    {
        $this->beConstructedWith('name', [['field_a', 199], 'field_b']);
        $this->getStm()->shouldBe('KEY `NAME` (`FIELD_A`(199), `FIELD_B`)');
    }

    public function it_can_set_unique_key_without_name()
    {
        $this->beConstructedWith('name', ['field_a', 'field_b']);
        $this->setType(Key::UNIQUE);
        $this->getStm()->shouldBe('UNIQUE KEY `NAME` (`FIELD_A`, `FIELD_B`)');
    }

    public function it_can_set_unique_only_field_name()
    {
        $this->beConstructedWith('name');
        $this->setType(Key::INDEX);
        $this->getStm()->shouldBe('KEY `NAME` (`NAME`)');
    }

    public function it_can_set_primary()
    {
        $this->beConstructedWith('name');
        $this->setType(Key::PRIMARY);
        $this->getStm()->shouldBe('PRIMARY KEY (`NAME`)');
    }
}
