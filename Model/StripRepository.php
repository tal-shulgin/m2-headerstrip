<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shulgin\Headerstrip\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Shulgin\Headerstrip\Api\Data\StripInterfaceFactory;
use Shulgin\Headerstrip\Api\Data\StripSearchResultsInterfaceFactory;
use Shulgin\Headerstrip\Api\StripRepositoryInterface;
use Shulgin\Headerstrip\Model\ResourceModel\Strip as ResourceStrip;
use Shulgin\Headerstrip\Model\ResourceModel\Strip\CollectionFactory as StripCollectionFactory;

class StripRepository implements StripRepositoryInterface
{
    private $storeManager;

    protected $dataObjectProcessor;

    private $collectionProcessor;

    protected $stripCollectionFactory;

    protected $stripFactory;

    protected $dataStripFactory;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    protected $extensionAttributesJoinProcessor;

    protected $resource;

    protected $dataObjectHelper;

    /**
     * @param ResourceStrip $resource
     * @param StripFactory $stripFactory
     * @param StripInterfaceFactory $dataStripFactory
     * @param StripCollectionFactory $stripCollectionFactory
     * @param StripSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceStrip $resource,
        StripFactory $stripFactory,
        StripInterfaceFactory $dataStripFactory,
        StripCollectionFactory $stripCollectionFactory,
        StripSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->stripFactory = $stripFactory;
        $this->stripCollectionFactory = $stripCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataStripFactory = $dataStripFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Shulgin\Headerstrip\Api\Data\StripInterface $strip
    ) {
        /* if (empty($strip->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $strip->setStoreId($storeId);
        } */

        $stripData = $this->extensibleDataObjectConverter->toNestedArray(
            $strip,
            [],
            \Shulgin\Headerstrip\Api\Data\StripInterface::class
        );

        $stripModel = $this->stripFactory->create()->setData($stripData);

        try {
            $this->resource->save($stripModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the strip: %1',
                $exception->getMessage()
            ));
        }
        return $stripModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($stripId)
    {
        $strip = $this->stripFactory->create();
        $this->resource->load($strip, $stripId);
        if (!$strip->getId()) {
            throw new NoSuchEntityException(__('strip with id "%1" does not exist.', $stripId));
        }
        return $strip->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->stripCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Shulgin\Headerstrip\Api\Data\StripInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Shulgin\Headerstrip\Api\Data\StripInterface $strip
    ) {
        try {
            $stripModel = $this->stripFactory->create();
            $this->resource->load($stripModel, $strip->getStripId());
            $this->resource->delete($stripModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the strip: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($stripId)
    {
        return $this->delete($this->get($stripId));
    }
}
