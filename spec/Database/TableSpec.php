<?php

namespace spec\tm\oxid\SchemaExpander\Database;

use tm\oxid\SchemaExpander\Database\Field;
use tm\oxid\SchemaExpander\Database\FieldInterface;
use tm\oxid\SchemaExpander\Database\Table;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Exception\Example\NotEqualException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class TableSpec
 *
 * @package spec\tm\oxid\SchemaExpander\Database
 */
class TableSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('oxtable');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Table::class);
        $this->shouldHaveType('tm\oxid\SchemaExpander\Database\TableInterface');
    }

    public function it_can_give_me_name()
    {
        $this->getTableName()->shouldBe('oxtable');
    }

    public function it_can_give_the_field()
    {
        $this->addField('Name', 'INI(11')->shouldHaveType(Table::class);
        $this->getFields()->shouldBeArray();
    }

    public function it_can_set_primary_keys()
    {
        $this->setPrimaryKey(['OXID', 'ZWEI'])->shouldHaveType(Table::class);
        $this->getKeys()->shouldBe(['PRIMARY KEY (`OXID`, `ZWEI`)']);
    }

    public function it_has_keys()
    {
        $this->setPrimaryKey(['OXID']);
        $this->hasKeys()->shouldBe(true);
    }

    public function it_has_not_keys()
    {
        $this->hasKeys()->shouldBe(false);
    }

    public function it_can_add_oxid_field()
    {
        $this->addFieldOxid()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveFieldType(Field\Oxid::class);
    }

    public function it_can_add_oxid_field_with_alter()
    {
        $this->addField('FIRST_FIELD', 'char(13)');
        $this->addFieldOxid()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveAlterStament('FIRST_FIELD');
    }

    public function it_can_add_timestamp_field()
    {
        $this->addFieldOxtimestamp()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveFieldType(Field\Oxtimestamp::class);
    }

    public function it_can_add_timestamp_field_with_alter()
    {
        $this->addField('FIRST_FIELD', 'char(13)');
        $this->addFieldOxtimestamp()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveAlterStament('FIRST_FIELD');
    }

    public function it_can_add_Oxshopid_field()
    {
        $this->addFieldOxshopid()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveFieldType(Field\Oxshopid::class);
    }

    public function it_can_add_Oxshopid_field_with_alter()
    {
        $this->addField('FIRST_FIELD', 'char(13)');
        $this->addFieldOxshopid()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveAlterStament('FIRST_FIELD');
    }

    public function it_can_add_Oxactive_field()
    {
        $this->addFieldOxactive()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveFieldType(Field\Oxactive::class);
    }

    public function it_can_add_Oxactive_field_with_alter()
    {
        $this->addField('FIRST_FIELD', 'char(13)');
        $this->addFieldOxactive()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveAlterStament('FIRST_FIELD');
    }

    public function it_can_add_Oxactivefrom_field()
    {
        $this->addFieldOxactiveFrom()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveFieldType(Field\Oxactivefrom::class);
    }

    public function it_can_add_Oxactivefrom_field_with_alter()
    {
        $this->addField('FIRST_FIELD', 'char(13)');
        $this->addFieldOxactiveFrom()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveAlterStament('FIRST_FIELD');
    }

    public function it_can_add_Oxactiveto_field()
    {
        $this->addFieldOxactiveTo()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveFieldType(Field\Oxactiveto::class);
    }

    public function it_can_add_Oxactiveto_field_with_alter()
    {
        $this->addField('FIRST_FIELD', 'char(13)');
        $this->addFieldOxactiveTo()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveAlterStament('FIRST_FIELD');
    }

    public function it_can_add_Oxlang_field()
    {
        $this->addFieldOxlang()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveFieldType(Field\Oxlang::class);
    }

    public function it_can_add_Oxlang_field_with_alter()
    {
        $this->addField('FIRST_FIELD', 'char(13)');
        $this->addFieldOxlang()->shouldHaveType(Table::class);
        $this->getFields()->shouldHaveAlterStament('FIRST_FIELD');
    }

    public function it_can_add_some_unique_keys()
    {
        $this->addUniqueKey('NAME', ['FieldA'])->shouldHaveType(Table::class);
        $this->addUniqueKey('NAMEB', ['FieldB'])->shouldHaveType(Table::class);
        $this->getKeys()->shouldBe(['UNIQUE KEY `NAME` (`FIELDA`)', 'UNIQUE KEY `NAMEB` (`FIELDB`)']);
    }

    public function it_can_add_some_index_keys()
    {
        $this->addKey('NAME', ['FieldA'])->shouldHaveType(Table::class);
        $this->getKeys()->shouldBe(['KEY `NAME` (`FIELDA`)']);
    }

    public function it_can_add_one_named_index()
    {
        $this->addKey('FIELDA')->shouldHaveType(Table::class);
        $this->getKeys()->shouldBe(['KEY `FIELDA` (`FIELDA`)']);
    }

    public function it_can_add_one_named_keys()
    {
        $this->addUniqueKey('FieldA')->shouldHaveType(Table::class);
        $this->addUniqueKey('FieldB')->shouldHaveType(Table::class);
        $this->getKeys()->shouldBe(['UNIQUE KEY `FIELDA` (`FIELDA`)', 'UNIQUE KEY `FIELDB` (`FIELDB`)']);
    }

    public function it_can_mark_that_will_be_after_a_column()
    {
        $this->addField('fieldB', 'char(12)');
        $this->after('fieldA')->shouldHaveType(Table::class);;
        $this->getFields()->shouldHaveAlterStament('fieldA');
    }

    public function it_can_add_new_field_with_alter_argument()
    {
        $this->addField('fieldZ', 'char(12)');
        $this->addField('fieldB', 'char(12)', 'fieldA');
        $this->getFields()->shouldHaveAlterStament('fieldA');
    }

    public function it_can_throw_exception_if_forget_to_add_field_by_after()
    {
        $this->shouldThrow(\LogicException::class)->during('after', ['fieldA']);
    }

    public function it_can_check_which_field_is_befor()
    {
        $this->addField('fieldA', 'char(12)');
        $this->addField('fieldB', 'char(12)');

        $this->getFields()->shouldHaveAlterStament('fieldA');
    }

    /**
     * @return array
     */
    public function getMatchers() : array
    {
        return [
            'haveFieldType' => function (array $actual, $type) {
                foreach ($actual as $field) {
                    if ($field instanceof $type) {
                        return true;
                    }
                }
                return false;
            },
            'haveAlterStament' => function (array $actual, $stament) {
                $lastIndex = count($actual);

                if (!isset($actual[$lastIndex-1])) {
                    throw new FailureException("No Fields found");
                }

                /** @var FieldInterface $field */
                $field = $actual[$lastIndex-1];
                if ($field->getAfterFieldname() != $stament) {
                    throw new NotEqualException(
                        sprintf("Alter stament, for `%s` is not Equal expect '%s' got '%s'", $field->getName(), $stament,  $field->getAfterFieldname()),
                        $stament,  $field->getAfterFieldname());
                };
                return true;
            },
        ];
    }
}
