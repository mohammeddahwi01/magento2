<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Customer\Controller\Adminhtml;

/**
 * Class Group
 *
 * @package Magento\Customer\Controller\Adminhtml
 */
abstract class Group extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
    /**
     * Authorization level of a basic admin session
     *
     * @see \Magento\Backend\App\Action\_isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Customer::group';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Customers'), __('Customers'))
            ->addBreadcrumb(__('Customer Group'), __('Customer Group'));
        return $resultPage;
    }
}
