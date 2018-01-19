<?php


namespace Heaven7\Hungarianzipcodes\Model;

use Heaven7\Hungarianzipcodes\Api\ZipRepositoryInterface;
use Heaven7\Hungarianzipcodes\Api\Data\ZipSearchResultsInterfaceFactory;
use Heaven7\Hungarianzipcodes\Api\Data\ZipInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Heaven7\Hungarianzipcodes\Model\ResourceModel\Zip as ResourceZip;
use Heaven7\Hungarianzipcodes\Model\ResourceModel\Zip\CollectionFactory as ZipCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class ZipRepository implements zipRepositoryInterface
{

    protected $resource;

    protected $zipFactory;

    protected $zipCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataZipFactory;

    private $storeManager;


    /**
     * @param ResourceZip $resource
     * @param ZipFactory $zipFactory
     * @param ZipInterfaceFactory $dataZipFactory
     * @param ZipCollectionFactory $zipCollectionFactory
     * @param ZipSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceZip $resource,
        ZipFactory $zipFactory,
        ZipInterfaceFactory $dataZipFactory,
        ZipCollectionFactory $zipCollectionFactory,
        ZipSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->zipFactory = $zipFactory;
        $this->zipCollectionFactory = $zipCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataZipFactory = $dataZipFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface $zip
    ) {
        /* if (empty($zip->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $zip->setStoreId($storeId);
        } */
        try {
            $zip->getResource()->save($zip);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the zip: %1',
                $exception->getMessage()
            ));
        }
        return $zip;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($zipId)
    {
        $zip = $this->zipFactory->create();
        $zip->getResource()->load($zip, $zipId);
        if (!$zip->getId()) {
            throw new NoSuchEntityException(__('Zip with id "%1" does not exist.', $zipId));
        }
        return $zip;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->zipCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface $zip
    ) {
        try {
            $zip->getResource()->delete($zip);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Zip: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($zipId)
    {
        return $this->delete($this->getById($zipId));
    }
}
