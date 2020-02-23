OXID - SchemaExpander
=====================

[![Build Status](https://travis-ci.org/TumTum/oxid-schema-expander.svg?branch=master)](https://travis-ci.org/TumTum/oxid-schema-expander)

Library to modify the OXID eShop database. Ideal for OXID modules to have their tables.

The tables will be reviewed and extended or created if necessary.

Example
-------
     
     public static function onModuleActivation()
     {
         $desireExpander = new \tm\oxid\SchemaExpander\DesireExpander();
         
         // Simple new Table
         $desireExpander->table('tm_example')
             ->addFieldOxid()
             ->addFieldOxactive()
             ->addFieldOxactiveFrom()
             ->addFieldOxactiveTo()
             ->addField('OXHASH', "char(32) COLLATE latin1_general_ci NOT NULL DEFAULT '' COMMENT 'Hash'")
             ->addField('OXTIME', "int(11) NOT NULL COMMENT 'Validation time'")
             ->addFieldOxtimestamp()
             ->setPrimaryKey('OXID');
         
         // Extent a oxarticles Table
         $desireExpander->table('oxarticles')
             ->addField('MYCOLUMN', "char(32) NOT NULL DEFAULT 'Wowo' COMMENT 'Extent only one Column'")
                 ->after('oxlang');
         
         // A Standart Enterprice Edtion Table
         $desireExpander->table('tm_example_enterprice')
             ->addFieldOxid()
             ->addFieldOxshopid()
             ->addFieldOxlang()
             ->addField('OXHASH',"char(32) COLLATE latin1_general_ci NOT NULL DEFAULT '' COMMENT 'Hash'")
             ->addField('OXTIME',"int(11) NOT NULL COMMENT 'Validation time'")
             ->addFieldOxtimestamp()
             ->setPrimaryKey('OXID')
             ->addKey('FASTFIND', [['OXHASH', 12], 'OXTIME']);
         
         //Commit all Tables
         $desireExpander->execute();
     }

Changelog
---------
- v1.0.0 Publishing

    

