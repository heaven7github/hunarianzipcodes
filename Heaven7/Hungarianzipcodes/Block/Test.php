<?php
/**
 * Copyright © 2017 Feherdi Lorand. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Heaven7\Hungarianzipcodes\Block;

use Magento\Framework\View\Element\Template;

/**
 * Aion Test Page block
 */
class Test extends Template
{
    /**
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Test function
     *
     * @return string
     */
    public function getTest()
    {
        return 'This is a test function for some logic...';
    }
}