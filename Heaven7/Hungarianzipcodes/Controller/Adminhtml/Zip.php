<?php


namespace Heaven7\Hungarianzipcodes\Controller\Adminhtml;

abstract class Zip extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Heaven7_Hungarianzipcodes::top_level';
    protected $_coreRegistry;

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
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Heaven7'), __('Heaven7'))
            ->addBreadcrumb(__('Zip'), __('Zip'));
        return $resultPage;
    }
}
