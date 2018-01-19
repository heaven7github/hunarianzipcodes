<?php


namespace Heaven7\Hungarianzipcodes\Model\ResourceModel\Zip;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Heaven7\Hungarianzipcodes\Model\Zip',
            'Heaven7\Hungarianzipcodes\Model\ResourceModel\Zip'
        );
    }
}
