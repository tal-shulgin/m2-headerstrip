<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shulgin\Headerstrip\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface StripRepositoryInterface
{

    /**
     * Save strip
     * @param \Shulgin\Headerstrip\Api\Data\StripInterface $strip
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Shulgin\Headerstrip\Api\Data\StripInterface $strip
    );

    /**
     * Retrieve strip
     * @param string $stripId
     * @return \Shulgin\Headerstrip\Api\Data\StripInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($stripId);

    /**
     * Retrieve strip matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Shulgin\Headerstrip\Api\Data\StripSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete strip
     * @param \Shulgin\Headerstrip\Api\Data\StripInterface $strip
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Shulgin\Headerstrip\Api\Data\StripInterface $strip
    );

    /**
     * Delete strip by ID
     * @param string $stripId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($stripId);
}
