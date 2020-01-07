<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel;

class Log extends \Magento\Framework\Model\ResourceModel\Db\VersionControl\AbstractDb
{
    protected function _construct()
    {
        $this->_init('shirtee_logs', 'lid');
    }
}
