<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shulgin\Headerstrip\Block;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Shulgin\Headerstrip\Api\StripRepositoryInterface;

class HeaderStrips extends \Magento\Framework\View\Element\Template
{
    /** @var ProductRepositoryInterface */
    protected $stripRepositoryInterface;

    /** @var SearchCriteriaBuilder */
    protected $searchCriteriaBuilder;

    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        StripRepositoryInterface $stripRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->stripRepositoryInterface = $stripRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getStrip()
    {
        $searchCriteria = $this->searchCriteriaBuilder
        ->addFilter('is_active', 1)
        ->addFilter('store_id', $this->_storeManager->getStore()->getId())->create();
        $messageList = $this->stripRepositoryInterface->getList($searchCriteria);
        return $messageList->getItems();
    }

    public function getImgSrc($item)
    {
        if (empty($item) || $item->getImg()) {
            return '';
        }

        $mediaUrl = $this->_storeManager->getStore()
        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'Headerstrip/image/';

        return $mediaUrl . $item->getImg();
    }

    public function getShowArrows(){
        return $this->scopeConfig->getValue('strip/general/show_arrows', 
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getShowDots(){
        return $this->scopeConfig->getValue('strip/general/show_dots', 
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
