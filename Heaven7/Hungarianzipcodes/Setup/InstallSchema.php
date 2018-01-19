<?php


namespace Heaven7\Hungarianzipcodes\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_heaven7_hungarianzipcodes_zip = $setup->getConnection()->newTable($setup->getTable('hungarian_zipcodes'));

        
        $table_heaven7_hungarianzipcodes_zip->addColumn(
            'zip_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            4,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Zip Code'
        );
        

        
        $table_heaven7_hungarianzipcodes_zip->addColumn(
            'city',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => False],
            'City'
        );
        

        $setup->getConnection()->createTable($table_heaven7_hungarianzipcodes_zip);

        $setup->endSetup();
    }
}
