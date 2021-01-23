<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Shulgin\Headerstrip\Controller\Adminhtml\Strip;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('strip_id');

            $model = $this->_objectManager->create(\Shulgin\Headerstrip\Model\Strip::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Strip no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $data = $this->setImageData($data);
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Strip.'));
                $this->dataPersistor->clear('shulgin_headerstrip_strip');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['strip_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Strip.'));
            }

            $this->dataPersistor->set('shulgin_headerstrip_strip', $data);
            return $resultRedirect->setPath('*/*/edit', ['strip_id' => $this->getRequest()->getParam('strip_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param array $data
     * @return array
     */
    private function setImageData(array $data)
    {
        $images = [
            'image'
        ];

        foreach ($images as $image) {
            if (isset($data[$image][0]['name'])) {
                $data[$image] = $data[$image][0]['name'];
            } else {
                $data[$image] = null;
            }
        }

        return $data;
    }
}
