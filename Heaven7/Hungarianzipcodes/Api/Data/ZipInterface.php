<?php


namespace Heaven7\Hungarianzipcodes\Api\Data;

interface ZipInterface
{

    const ZIP_CODE = 'zip_code';
    const CITY = 'city';


    /**
     * Get zip_id
     * @return string|null
     */
    public function getZipCode();

    /**
     * Set zip_id
     * @param string $zip_id
     * @return \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface
     */
    public function setZipCode($zipId);

    /**
     * Get code
     * @return string|null
     */
    public function getCity();

    /**
     * Set code
     * @param string $code
     * @return \Heaven7\Hungarianzipcodes\Api\Data\ZipInterface
     */
    public function setCity($code);
}
