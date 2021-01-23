<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shulgin\Headerstrip\Api\Data;

interface StripInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const STORE_ID = 'store_id';
    const STRIP_ID = 'strip_id';
    const IS_ACTIVE = 'is_active';
    const IMAGE = 'image';
    const IMAGE_INC = 'image_inc';
    const MSG = 'msg';

    /**
     * Get strip_id
     * @return string|null
     */
    public function getStripId();

    /**
     * Set strip_id
     * @param string $stripId
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setStripId($stripId);

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId();

    /**
     * Set store_id
     * @param string $storeId
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setStoreId($storeId);

    /**
     * Get image_inc
     * @return string|null
     */
    public function getImageInc();

    /**
     * Set image_inc
     * @param string $imageInc
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setImageInc($imageInc);

    /**
     * Get image
     * @return string|null
     */
    public function getImage();

    /**
     * Set image
     * @param string $image
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setImage($image);

    /**
     * Get is_active
     * @return string|null
     */
    public function getIsActive();

    /**
     * Set is_active
     * @param string $isActive
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setIsActive($isActive);

    /**
     * Get msg
     * @return string|null
     */
    public function getMsg();

    /**
     * Set msg
     * @param string $msg
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     */
    public function setMsg($msg);
}
