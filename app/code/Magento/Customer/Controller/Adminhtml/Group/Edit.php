<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Customer\Controller\Adminhtml\Group;

/**
 * Class Edit
 *
 * @package Magento\Customer\Controller\Adminhtml\Group
 */
class Edit extends \Magento\Customer\Controller\Adminhtml\Group
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $groupId = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\Magento\Customer\Model\Group::class);

        // 2. Initial checking
        if ($groupId) {
            $model->load($groupId);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Group no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('customer_group', $model);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            __('General'),
            __('General')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Groups'));
        $resultPage->getConfig()->getTitle()->prepend(__('General'));
        return $resultPage;
    }
}
