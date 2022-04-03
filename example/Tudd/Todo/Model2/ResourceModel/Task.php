<?php
namespace Tudd\Todo\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use \Magento\Framework\Model\ResourceModel\Db\Context;

class Task extends AbstractDb
{
	protected function _construct()
	{
		$this->_init('tudd_task', 'task_id');
	}
}