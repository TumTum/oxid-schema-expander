<?php

namespace spec\tm\oxid\SchemaExpander;

use tm\oxid\SchemaExpander\ExtendTables;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use tm\oxid\SchemaExpander\Database\ConnectorInterface;
use tm\oxid\SchemaExpander\Database\TableInterface;
use tm\oxid\SchemaExpander\Database\FieldInterface;

/**
 * Class ExtendTableSpec
 * @package spec\tm\oxid\SchemaExpander
 */
class ExtendTablesSpec extends ObjectBehavior
{

    public function let(ConnectorInterface $connector,
                        TableInterface $table,
                        FieldInterface $fieldA,
                        FieldInterface $fieldB
    )
    {
        $this->beConstructedWith($connector);

        $table->getTableName()->willReturn('oxtable');
        $table->getFields()->willReturn([$fieldA, $fieldB]);

        $fieldA->getName()->willReturn('field_a');
        $fieldA->getAlterStm()->willReturn("INT(11) NOT NULL DEFAULT '0'");
        $fieldA->getAfterFieldname()->willReturn("field_b");

        $fieldB->getName()->willReturn('field_b');
        $fieldB->getAlterStm()->willReturn("INT(11) NOT NULL DEFAULT '0'");
        $fieldB->getAfterFieldname()->willReturn("");
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('tm\oxid\SchemaExpander\ExtendTables');
    }

    public function it_can_table_table_info(TableInterface $table)
    {
        $this->addTable($table)->shouldHaveType('tm\oxid\SchemaExpander\ExtendTables');
    }

    public function it_can_extendet_table(ConnectorInterface $connector, TableInterface $table)
    {
        $connector->getAll(Argument::is('SHOW COLUMNS FROM oxtable'))->willReturn([
            ['Field' => 'OXOBJECTID', 'Type' => 'char(32)'],
            ['Field' => 'OXIDENT', 'Type' => 'char(32)'],
            ['Field' => 'FIELD_B', 'Type' => 'INT(11)'],
        ])->shouldBeCalled();

        $connector->execute(Argument::is('ALTER TABLE `oxtable` ADD COLUMN `FIELD_A` INT(11) NOT NULL DEFAULT \'0\' AFTER `FIELD_B`'))->shouldBeCalled();

        $this->addTable($table);
        $this->execute();
    }

    public function it_db_error(ConnectorInterface $connector, TableInterface $table)
    {
        $connector->getAll(Argument::is('SHOW COLUMNS FROM oxtable'))->willReturn([
            ['GibtEsNicht' => 'OXOBJECTID', 'Type' => 'char(32)'],
        ])->shouldBeCalled();


        $this->addTable($table);
        $this->shouldThrow(\Exception::class)->during('execute');
    }

    public function it_should_be_create_a_table(
        ConnectorInterface $connector,
        TableInterface $table
    )
    {
        $Exception = new \Exception('table_doesn_not_exist', 1146);
        $connector->getAll(Argument::is('SHOW COLUMNS FROM oxtable'))->willThrow($Exception);

        $connector->execute(Argument::is('CREATE TABLE `oxtable` (`FIELD_A` INT(11) NOT NULL DEFAULT \'0\', `FIELD_B` INT(11) NOT NULL DEFAULT \'0\') ENGINE=InnoDB'))->shouldBeCalled();
        $connector->execute(Argument::is('ALTER TABLE `oxtable` ADD PRIMARY KEY (`FIELD_A`)'))->shouldBeCalled();
        $connector->execute(Argument::is('ALTER TABLE `oxtable` ADD KEY `NAME` (`FIELD_B`)'))->shouldBeCalled();

        $table->hasKeys()->willReturn(true);
        $table->getKeys()->willReturn(['PRIMARY KEY (`FIELD_A`)', 'KEY `NAME` (`FIELD_B`)']);

        $this->addTable($table);
        $this->execute();
    }

    public function it_should_be_add_more_than_one_table(
        TableInterface $table,
        TableInterface $tableB,
        TableInterface $tableC
    )
    {
        $this->addTables([$table, $tableB, $tableC])->shouldHaveType(ExtendTables::class);
    }
}
