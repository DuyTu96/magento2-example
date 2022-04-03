<?php

namespace Repo\Posts\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Repo\Posts\Api\Data\BlogInterface;

/**
 * Class Custom
 * @package Repo\Post\Model
 */
class Blog extends AbstractExtensibleModel implements BlogInterface
{
    const ENTITY_ID = 'id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const VIEW = 'view';
    const CREATED_AT = 'created_at';

    protected function _construct()
    {
        $this->_init(\Repo\Posts\Model\ResourceModel\Post::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setEntityId($entityId)
    {
        $this->setData(self::ENTITY_ID, $entityId);
        return $this;
    }

    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    public function setTitle($value)
    {
        $this->setData(self::TITLE, $value);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->setData(self::DESCRIPTION, $description);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getView()
    {
        return $this->getData(self::VIEW);
    }

    /**
     * {@inheritdoc}
     */
    public function setView($view)
    {
        $this->setData(self::VIEW, $view);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);
        return $this;
    }
}
