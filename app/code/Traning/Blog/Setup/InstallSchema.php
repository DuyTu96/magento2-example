<?php

namespace Training\Blog\Setup;

use \Magento\Framework\DB\Ddl\Table;
use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();

		if (!$installer->tableExists('blogs')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('blogs')
			)
				->addColumn(
					'id',
					Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Blogs ID'
				)
				->addColumn(
					'title',
					Table::TYPE_TEXT,
					255,
					['nullable' => false],
					'Blog title'
				)
				->addColumn(
					'content',
					Table::TYPE_TEXT,
					'64k',
					[],
					'content'
				)
				->addColumn(
					'image',
					Table::TYPE_TEXT,
					null,
					['nullable' => true],
					'Image of post'
				)
				->addColumn(
					'created_by',
					Table::TYPE_INTEGER,
					null,
					['nullable' => false],
					'Created By'
				)->addColumn(
					'updated_by',
					Table::TYPE_INTEGER,
					null,
					['nullable' => false],
					'Updated By'
				)
				->addColumn(
					'status',
					Table::TYPE_INTEGER,
					1,
					['nullable' => false],
					'Blog Status'
				)
				->addColumn(
					'created_at',
					Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
					'Created At'
				)->addColumn(
					'updated_at',
					Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
					'Updated At')
				->setComment('Create Blogs Table');

			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('blogs'),
				$setup->getIdxName(
					$installer->getTable('blogs'),
					['title', 'content', 'image', 'created_by', 'updated_by', 'status'],
					AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['title', 'content', 'image', 'created_by', 'updated_by', 'status'],
				AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}

		$installer->endSetup();
	}
}
