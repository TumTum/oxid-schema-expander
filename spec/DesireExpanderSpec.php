<?php

namespace spec\tm\oxid\SchemaExpander;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use tm\oxid\SchemaExpander\Database;
use tm\oxid\SchemaExpander\DesireExpander;
use tm\oxid\SchemaExpander\ExtendTables;

/**
 * Class DesireExpanderSpec
 * 
 * @package spec\tm\oxid\SchemaExpander
 */
class DesireExpanderSpec extends ObjectBehavior
{
    public function let(ExtendTables $extendTables)
    {
        $this->beConstructedWith($extendTables);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DesireExpander::class);
    }

    public function it_can_contain_information_about_tables(ExtendTables $extendTables)
    {
        //Act
        $this->table('table_name')
            ->shouldHaveType(Database\Table::class);

        //Assert
        $extendTables
            ->addTable(Argument::type(Database\TableInterface::class))
            ->shouldBeCalled();
    }

    public function it_can_be_implemented_the_desired_changes(ExtendTables $extendTables)
    {
        //Arrange
        $this->table('table_A')->addFieldOxid();
        $this->table('table_B')->addFieldOxid();

        //Act
        $this->execute();

        //Assert
        $extendTables->addTable(Argument::any())->shouldBeCalledTimes(2);
        $extendTables->execute()->shouldBeCalled();
    }
}
