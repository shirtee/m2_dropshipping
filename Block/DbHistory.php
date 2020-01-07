<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block;

class DbHistory extends \Magento\Framework\View\Element\Template
{
    public $shirteeHelper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Shirtee\Dropshipping\Helper\Data $shirteeHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->shirteeHelper = $shirteeHelper;
    }

    public function getDbHistory()
    {
        $collection = null;

        $table = $this->getData("table");
        $page = $this->getData("page");
        $limit = $this->getData("limit");

        if (!$page) {
            $page = 1;
        }

        if (!$limit) {
            $limit = 20;
        }

        if ($table != "") {
            $type = $table.'CollectionFactory';
            $collection = $this->shirteeHelper->{$type}->create()->setCurPage($page)->setPageSize($limit);
        }

        return $collection;
    }
}
