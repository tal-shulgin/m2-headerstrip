<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shulgin\Headerstrip\Model;

use Magento\Framework\Api\DataObjectHelper;
use Shulgin\Headerstrip\Api\Data\StripInterface;
use Shulgin\Headerstrip\Api\Data\StripInterfaceFactory;

class Strip extends \Magento\Framework\Model\AbstractModel
{
    protected $_eventPrefix = 'shulgin_headerstrip_strip';
    protected $stripDataFactory;

    protected $dataObjectHelper;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param StripInterfaceFactory $stripDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Shulgin\Headerstrip\Model\ResourceModel\Strip $resource
     * @param \Shulgin\Headerstrip\Model\ResourceModel\Strip\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        StripInterfaceFactory $stripDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Shulgin\Headerstrip\Model\ResourceModel\Strip $resource,
        \Shulgin\Headerstrip\Model\ResourceModel\Strip\Collection $resourceCollection,
        array $data = []
    ) {
        $this->stripDataFactory = $stripDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve strip model with strip data
     * @return StripInterface
     */
    public function getDataModel()
    {
        $stripData = $this->getData();

        $stripDataObject = $this->stripDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $stripDataObject,
            $stripData,
            StripInterface::class
        );

        return $stripDataObject;
    }
}
