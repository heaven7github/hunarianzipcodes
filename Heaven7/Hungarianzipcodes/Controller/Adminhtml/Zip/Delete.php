<?php


namespace Heaven7\Hungarianzipcodes\Controller\Adminhtml\Zip;

class Delete extends \Heaven7\Hungarianzipcodes\Controller\Adminhtml\Zip
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
        $id = $this->getRequest()->getParam('zip_code');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('Heaven7\Hungarianzipcodes\Model\Zip');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Zip.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['zip_code' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Zip to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
