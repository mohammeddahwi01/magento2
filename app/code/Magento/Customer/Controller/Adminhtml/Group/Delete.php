<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Customer\Controller\Adminhtml\Group;

/**
 * Class Delete
 *
 * @package Magento\Customer\Controller\Adminhtml\Group
 */
class Delete extends \Magento\Customer\Controller\Adminhtml\Group
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $groupId = $this->getRequest()->getParam('id');
        if ($groupId) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Magento\Customer\Model\Group::class);
                $model->load($groupId);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Group.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['group_id' => $groupId]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Group to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
