<?php


namespace Heaven7\Hungarianzipcodes\Controller\Adminhtml\Zip;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    protected $zipRepository;

    protected $zipFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Heaven7\Hungarianzipcodes\Api\ZipRepositoryInterface $zipRepository = null,
        \Heaven7\Hungarianzipcodes\Model\ZipFactory $zipFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->zipFactory = $zipFactory;
        $this->zipRepository = $zipRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Heaven7\Hungarianzipcodes\Model\ZipRepository::class);
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
            $id = $this->getRequest()->getParam('zip_code');

            /** @var \Heaven7\Hungarianzipcodes\Model\Zip $model */
            $model = $this->zipFactory->create();
            //$model = $this->_objectManager->create('Heaven7\Hungarianzipcodes\Model\Zip')/*->load($id)*/;
            //if (!$model->getZipCode() && $id) {
            //    $this->messageManager->addErrorMessage(__('This Zip no longer exists.'));
            //    return $resultRedirect->setPath('*/*/');
            //}
            var_dump($data);die;
            $model->setData($data);
        
            try {
                $this->zipRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the Zip.'));
                $this->dataPersistor->clear('hungarian_zipcodes');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['zip_code' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Zip.'));
            }
        
            $this->dataPersistor->set('heaven7_hungarianzipcodes_zip', $data);
            return $resultRedirect->setPath('*/*/edit', ['zip_code' => $this->getRequest()->getParam('zip_code')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
