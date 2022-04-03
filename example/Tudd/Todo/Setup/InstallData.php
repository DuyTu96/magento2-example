<?php

namespace Tudd\Todo\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Tudd\Todo\Model\TaskFactory;

class InstallData implements InstallDataInterface
{
	protected $_taskFactory;

	public function __construct(TaskFactory $taskFactory)
	{
		$this->_taskFactory = $taskFactory;
	}

	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();
		for ($i=1; $i <= 100; $i++) { 
			$data = [
				'name'         	=> "Task " . $i,
				'description' 	=> "In this article, we will find out how to install and upgrade sql script for module in Magento 2. When you install or upgrade a module, you may need to change the database structure or add some new data for current table. To do this, Magento 2 provide you some classes which you can do all of them.",
				'created_by'    => 1,
				'updated_by'    => 1,
				'status'       	=> 0
			];

			$setup->getConnection()->insert("tudd_task", $data);
		}

		$setup->endSetup();
	}
}
