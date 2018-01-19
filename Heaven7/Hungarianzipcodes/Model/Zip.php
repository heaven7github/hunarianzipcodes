<?php


namespace Heaven7\Hungarianzipcodes\Model;

use Heaven7\Hungarianzipcodes\Api\Data\ZipInterface;

class Zip extends \Magento\Framework\Model\AbstractModel implements ZipInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Heaven7\Hungarianzipcodes\Model\ResourceModel\Zip');
    }

    /**
     * Get zip_id
     * @return string
     */
    public function getZipCode()
    {
        return $this->getData(self::ZIP_CODE);
    }

    /**
     * Set zip_id
     * @param string $zipId
     * @return \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface
     */
    public function setZipCode($zipId)
    {
        return $this->setData(self::ZIP_ID, $zipId);
    }

    /**
     * Get code
     * @return string
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * Set code
     * @param string $code
     * @return \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface
     */
    public function setCity($city)
    {
        return $this->setData(self::CODE, $city);
    }
}
