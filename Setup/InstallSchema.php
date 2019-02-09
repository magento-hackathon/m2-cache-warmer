<?php
/**
 * Created by PhpStorm.
 * User: utietze
 * Date: 09.02.19
 * Time: 20:36
 */

namespace Firegento\CacheWarmup\Setup;

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
        if (!$installer->tableExists('cache_tags')) {
            $cacheTagTable = $installer->getConnection()->newTable(
                $installer->getTable('cache_tags')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Cache Tag ID'
                )
                ->addColumn(
                    'cache_tag',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Cache Tag'
                )
                ->setComment('Cache Tag Table');
            $installer->getConnection()->createTable($cacheTagTable);

            $cacheRouteTable = $installer->getConnection()->newTable(
                $installer->getTable('cache_routes')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Cache Route ID'
                )
                ->addColumn(
                    'cache_route',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    "2M",
                    ['nullable => false'],
                    'Cache Route'
                )
                ->addColumn(
                    'cache_status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    1,
                    ['nullable => false'],
                    'Cache Status'
                )
                ->addColumn(
                    'lifetime',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['nullable => false'],
                    'Cache Route Lifetime'
                )
                ->addColumn(
                    'popularity',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['nullable => false'],
                    'Cache Route Populariy'
                )
                ->setComment('Cache Route Table');
            $installer->getConnection()->createTable($cacheRouteTable);

            $cacheRouteTagTable = $installer->getConnection()->newTable(
                $installer->getTable('cache_routes_tags')
            )
                ->addColumn(
                    'route_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Cache Tag ID'
                )
                ->addColumn(
                    'tag_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Cache Tag'
                )
                ->setComment('Cache Tag Table');
            $installer->getConnection()->createTable($cacheRouteTagTable);

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
        $installer->endSetup();



    }
}