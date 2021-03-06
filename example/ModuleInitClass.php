<?php

use tm\oxid\SchemaExpander\DesireExpander;

class ModuleInitEvents
{
    public static function onModuleActivation()
    {
        $desire = new DesireExpander();

        // Simple create new table
        $desire
            ->table('tm_example')
                ->addFieldOxid()
                ->addFieldOxactive()
                ->addFieldOxactiveFrom()
                ->addFieldOxactiveTo()
                ->addField('OXHASH', "char(32) COLLATE latin1_general_ci NOT NULL DEFAULT '' COMMENT 'Hash'")
                ->addField('OXTIME', "int(11) NOT NULL COMMENT 'Validation time'")
                ->addFieldOxtimestamp()
                ->setPrimaryKey('OXID');

        // Extent a oxarticles table
        $desire
            ->table('oxarticles')
                ->addField('MYCOLUMN', "char(32) NOT NULL DEFAULT 'Wowo' COMMENT 'Extent only one Column'")
                ->after('oxlang');

        // A standard oxid-ee table
        $desire
            ->table('tm_example_enterprice')
                ->addFieldOxid()
                ->addFieldOxshopid()
                ->addFieldOxlang()
                ->addField('OXHASH', "char(32) COLLATE latin1_general_ci NOT NULL DEFAULT '' COMMENT 'Hash'")
                ->addField('OXTIME', "int(11) NOT NULL COMMENT 'Validation time'")
                ->addFieldOxtimestamp()
                ->setPrimaryKey('OXID')
                ->addKey('FASTFIND', [['OXHASH', 12], 'OXTIME']);

        //Commit all Tables
        $desire->execute();
    }

    public static function onModuleDeactivation()
    {
    }
}
