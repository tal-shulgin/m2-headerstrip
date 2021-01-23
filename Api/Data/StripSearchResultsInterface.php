<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shulgin\Headerstrip\Api\Data;

interface StripSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get strip list.
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface[]
     */
    public function getItems();

    /**
     * Set store_id list.
     * @param \Shulgin\Headerstrip\Api\Data\StripInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
