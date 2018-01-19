<?php


namespace Heaven7\Hungarianzipcodes\Api\Data;

interface ZipSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Zip list.
     * @return \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface[]
     */
    public function getItems();

    /**
     * Set code list.
     * @param \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
