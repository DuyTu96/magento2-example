<?php
namespace Mageplaza\HelloWorld\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\DB\Ddl\Table;
use \Magento\Framework\DB\Adapter\AdapterInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;

		$installer->startSetup();

		if(version_compare($context->getVersion(), '1.1.0', '<')) {
			if (!$installer->tableExists('mageplaza_helloworld_post')) {
				$table = $installer->getConnection()->newTable(
					$installer->getTable('mageplaza_helloworld_post')
				)
					->addColumn(
						'post_id',
						Table::TYPE_INTEGER,
						null,
						[
							'identity' => true,
							'nullable' => false,
							'primary'  => true,
							'unsigned' => true,
						],
						'Post ID'
					)
					->addColumn(
						'name',
						Table::TYPE_TEXT,
						255,
						['nullable => false'],
						'Post Name'
					)
					->addColumn(
						'url_key',
						Table::TYPE_TEXT,
						255,
						[],
						'Post URL Key'
					)
					->addColumn(
						'post_content',
						Table::TYPE_TEXT,
						'64k',
						[],
						'Post Post Content'
					)
					->addColumn(
						'tags',
						Table::TYPE_TEXT,
						255,
						[],
						'Post Tags'
					)
					->addColumn(
						'status',
						Table::TYPE_INTEGER,
						1,
						[],
						'Post Status'
					)
					->addColumn(
						'featured_image',
						Table::TYPE_TEXT,
						255,
						[],
						'Post Featured Image'
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
					->setComment('Post Table');
				$installer->getConnection()->createTable($table);

				$installer->getConnection()->addIndex(
					$installer->getTable('mageplaza_helloworld_post'),
					$setup->getIdxName(
						$installer->getTable('mageplaza_helloworld_post'),
						['name','url_key','post_content','tags','featured_image'],
						AdapterInterface::INDEX_TYPE_FULLTEXT
					),
					['name','url_key','post_content','tags','featured_image'],
					AdapterInterface::INDEX_TYPE_FULLTEXT
				);
			}
		}

		if(version_compare($context->getVersion(), '1.2.0', '<')) {
			$installer->getConnection()->addColumn(
				$installer->getTable( 'mageplaza_helloworld_post' ),
				'test222',
				[
					'type' => Table::TYPE_DECIMAL,
					'nullable' => true,
					'length' => '12,4',
					'comment' => 'test',
					'after' => 'status'
				]
			);
		}

		if(version_compare($context->getVersion(), '1.3.0', '<')) {
			$installer->getConnection()->addColumn(
				$installer->getTable( 'mageplaza_helloworld_post' ),
				'test2223',
				[
					'type' => Table::TYPE_DECIMAL,
					'nullable' => true,
					'length' => '12,4',
					'comment' => 'test',
					'after' => 'status'
				]
			);
		}

		$installer->endSetup();
	}
}