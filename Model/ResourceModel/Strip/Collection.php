<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shulgin\Headerstrip\Model\ResourceModel\Strip;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'strip_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Shulgin\Headerstrip\Model\Strip::class,
            \Shulgin\Headerstrip\Model\ResourceModel\Strip::class
        );
    }
}
