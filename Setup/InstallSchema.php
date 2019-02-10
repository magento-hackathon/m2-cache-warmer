<?php

namespace Firegento\CacheWarmup\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $setup->getConnection()->createTable($this->getCacheTagTableDefinition($setup));
        $setup->getConnection()->createTable($this->getCacheRouteTableDefinition($setup));
        $setup->getConnection()->createTable($this->getCacheRouteTagTableDefinition($setup));
        $setup->getConnection()->createTable($this->getVaryDataTableDefinition($setup));
        $this->addCacheRouteTagForeignKeys($setup);
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     * @return \Magento\Framework\DB\Ddl\Table
     * @throws \Zend_Db_Exception
     */
    private function getCacheTagTableDefinition(SchemaSetupInterface $setup): \Magento\Framework\DB\Ddl\Table
    {
        return $setup->getConnection()->newTable($setup->getTable('cache_tags'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'Cache Tag ID'
            )
            ->addColumn(
                'cache_tag',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Cache Tag'
            )
            ->setComment('Cache Tag Table');
    }

    /**
     * @param SchemaSetupInterface $setup
     * @return \Magento\Framework\DB\Ddl\Table
     * @throws \Zend_Db_Exception
     */
    private function getVaryDataTableDefinition(SchemaSetupInterface $setup): \Magento\Framework\DB\Ddl\Table
    {
        return $setup->getConnection()->newTable($setup->getTable('cache_vary_data'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'Cache Vary Data ID'
            )
            ->addColumn(
                'vary_data',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Cache Vary Data'
            )
            ->setComment('Cache Vary Data Table');
    }

    /**
     * @param SchemaSetupInterface $setup
     * @return \Magento\Framework\DB\Ddl\Table
     * @throws \Zend_Db_Exception
     */
    private function getCacheRouteTableDefinition(SchemaSetupInterface $setup): \Magento\Framework\DB\Ddl\Table
    {
        return $setup->getConnection()->newTable($setup->getTable('cache_routes'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'Cache Route ID'
            )
            ->addColumn(
                'cache_route',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Cache Route'
            )
            ->addIndex(
                $setup->getIdxName(
                    'cache_routes',
                    ['cache_route'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                ['cache_route'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addColumn(
                'cache_status',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                1,
                ['nullable' => false],
                'Cache Status'
            )
            ->addColumn(
                'lifetime',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false],
                'Cache Route Lifetime'
            )
            ->addColumn(
                'popularity',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false],
                'Cache Route Populariy'
            )
            ->setComment('Cache Route Table');
    }

    /**
     * @param SchemaSetupInterface $setup
     * @return \Magento\Framework\DB\Ddl\Table
     * @throws \Zend_Db_Exception
     */
    private function getCacheRouteTagTableDefinition(SchemaSetupInterface $setup): \Magento\Framework\DB\Ddl\Table
    {
        return $setup->getConnection()->newTable($setup->getTable('cache_routes_tags'))
            ->addColumn(
                'route_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true],
                'Cache Tag ID'
            )
            ->addColumn(
                'tag_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable => false', 'unsigned' => true],
                'Cache Tag'
            )
            ->setComment('Cache Tag Table');
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addCacheRouteTagForeignKeys(SchemaSetupInterface $setup): void
    {
        /**
         * Add foreign keys again
         */
        $setup->getConnection()->addForeignKey(
            $setup->getFkName(
                'cache_routes',
                'id',
                'cache_route_tags',
                'route_id'
            ),
            $setup->getTable('cache_routes_tags'),
            'route_id',
            $setup->getTable('cache_routes'),
            'id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        );
        $setup->getConnection()->addForeignKey(
            $setup->getFkName(
                'cache_tags',
                'id',
                'cache_route_tags',
                'tag_id'
            ),
            $setup->getTable('cache_routes_tags'),
            'tag_id',
            $setup->getTable('cache_tags'),
            'id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        );
    }
}
