<?php

use tm\oxid\SchemaExpander\DesireExpander;

class ModuleInitEvents
{
    public static function onModuleActivation()
    {
        $desireExpander = new DesireExpander();

        // Simple create new table
        $desireExpander->table('tm_example')
            ->addFieldOxid()
            ->addFieldOxactive()
            ->addFieldOxactiveFrom()
            ->addFieldOxactiveTo()
            ->addField('OXHASH', "char(32) COLLATE latin1_general_ci NOT NULL DEFAULT '' COMMENT 'Hash'")
            ->addField('OXTIME', "int(11) NOT NULL COMMENT 'Validation time'")
            ->addFieldOxtimestamp()
            ->setPrimaryKey('OXID');

        // Extent a oxarticles table
        $desireExpander->table('oxarticles')
            ->addField('MYCOLUMN', "char(32) NOT NULL DEFAULT 'Wowo' COMMENT 'Extent only one Column'")
            ->after('oxlang');

        // A standard oxid-ee table
        $desireExpander->table('tm_example_enterprice')
            ->addFieldOxid()
            ->addFieldOxshopid()
            ->addFieldOxlang()
            ->addField('OXHASH', "char(32) COLLATE latin1_general_ci NOT NULL DEFAULT '' COMMENT 'Hash'")
            ->addField('OXTIME', "int(11) NOT NULL COMMENT 'Validation time'")
            ->addFieldOxtimestamp()
            ->setPrimaryKey('OXID')
            ->addKey('FASTFIND', [['OXHASH', 12], 'OXTIME']);

        //Commit all Tables
        $desireExpander->execute();
    }

    public static function onModuleDeactivation()
    {
    }
}
