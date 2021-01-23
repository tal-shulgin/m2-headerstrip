<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shulgin\Headerstrip\Model\Data;

use Magento\Store\Model\StoreManagerInterface;
use Shulgin\Headerstrip\Api\Data\StripInterface;

class Strip extends \Magento\Framework\Api\AbstractExtensibleObject implements StripInterface
{
    private $storeManager;

    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    /**
     * Get strip_id
     * @return string|null
     */
    public function getStripId()
    {
        return $this->_get(self::STRIP_ID);
    }

    /**
     * Set strip_id
     * @param string $stripId
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setStripId($stripId)
    {
        return $this->setData(self::STRIP_ID, $stripId);
    }

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId()
    {
        return $this->_get(self::STORE_ID);
    }

    /**
     * Set store_id
     * @param string $storeId
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Get image_inc
     * @return string|null
     */
    public function getImageInc()
    {
        return $this->_get(self::IMAGE_INC);
    }

    /**
     * Set image_inc
     * @param string $imageInc
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setImageInc($imageInc)
    {
        return $this->setData(self::IMAGE_INC, $imageInc);
    }

    /**
     * Get image
     * @return string|null
     */
    public function getImage()
    {
        $mediaUrl = $this->storeManager->getStore()
        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'Headerstrip/image/';

        return $mediaUrl . $this->_get(self::IMAGE);
    }

    /**
     * Set image
     * @param string $image
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * Get is_active
     * @return string|null
     */
    public function getIsActive()
    {
        return $this->_get(self::IS_ACTIVE);
    }

    /**
     * Set is_active
     * @param string $isActive
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get msg
     * @return string|null
     */
    public function getMsg()
    {
        return $this->_get(self::MSG);
    }

    /**
     * Set msg
     * @param string $msg
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setMsg($msg)
    {
        return $this->setData(self::MSG, $msg);
    }
}
