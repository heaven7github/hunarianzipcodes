<?php


namespace Heaven7\Hungarianzipcodes\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ZipRepositoryInterface
{


    /**
     * Save Zip
     * @param \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface $zip
     * @return \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface $zip
    );

    /**
     * Retrieve Zip
     * @param string $zipId
     * @return \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($zipId);

    /**
     * Retrieve Zip matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Heaven7\Hungarianzipcodes\Api\Data\ZipSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Zip
     * @param \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface $zip
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface $zip
    );

    /**
     * Delete Zip by ID
     * @param string $zipId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($zipId);
}
