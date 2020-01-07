<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class SalesOrderSaveAfter implements ObserverInterface
{
    public $shirteeHelper;

    public function __construct(
        \Shirtee\Dropshipping\Helper\Data $shirteeHelper
    ) {
        $this->shirteeHelper = $shirteeHelper;
    }

    public function execute(EventObserver $observer)
    {
        $order = $observer->getEvent()->getOrder();
        if (!$order) {
        	return $this;
        }

        $order = $this->shirteeHelper->magentoOrderPlaceAfter($order);
        return $this;
    }
}
