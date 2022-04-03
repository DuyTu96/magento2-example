<?php

namespace Repo\Posts\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface CustomInterface
 * @package Repo\Post\Api\Data
 */
interface PostInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param int $entityId
     * @return $this
     */
    public function setEntityId(int $entityId);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description);

    /**
     * @return int
     */
    public function getView();

    /**
     * @param int $view
     * @return $this
     */
    public function setView(int $view);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt);
}
