<?php

namespace Tudd\Todo\Setup;

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

		if (!$installer->tableExists('tudd_task')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('tudd_task')
			)
				->addColumn(
					'task_id',
					Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Task ID'
				)
				->addColumn(
					'name',
					Table::TYPE_TEXT,
					255,
					['nullable' => false],
					'Task Name'
				)
				->addColumn(
					'description',
					Table::TYPE_TEXT,
					'64k',
					[],
					'description'
				)
				->addColumn(
					'created_by',
					Table::TYPE_INTEGER,
					null,
					['nullable' => false],
					'Created By'
				)
				->addColumn(
					'updated_by',
					Table::TYPE_INTEGER,
					null,
					['nullable' => false],
					'Post Tags'
				)
				->addColumn(
					'status',
					Table::TYPE_INTEGER,
					1,
					['nullable' => false],
					'Post Status'
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
				->setComment('Tudd Task Table');

			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('tudd_task'),
				$setup->getIdxName(
					$installer->getTable('tudd_task'),
					['name', 'description', 'created_by', 'updated_by', 'status'],
					AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['name', 'description', 'created_by', 'updated_by', 'status'],
				AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}
		
		$installer->endSetup();
	}
}