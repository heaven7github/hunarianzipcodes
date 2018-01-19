<?php


namespace Heaven7\Hungarianzipcodes\Model\ResourceModel;

class Zip extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_isPkAutoIncrement = false;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('hungarian_zipcodes', 'zip_code');
    }
}
