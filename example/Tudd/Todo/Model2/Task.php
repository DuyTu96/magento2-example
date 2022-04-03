<?php
namespace Tudd\Todo\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Task extends AbstractModel implements IdentityInterface
{
	const CACHE_TAG = 'tudd_task';

	protected $_cacheTag = 'tudd_task';

	protected $_eventPrefix = 'tudd_task';

	protected function _construct()
	{
		$this->_init('Tudd\Todo\Model\ResourceModel\Task');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}