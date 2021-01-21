<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Orders;

class Sync extends \Shirtee\Dropshipping\Controller\Orders
{
    public function execute()
    {
    	try {
    		$this->shirteeHelper->cronSyncOrders();

            $response = $this->getResponse()->setBody(json_encode(["status" => "success"]));
            return $response;
    	} catch (Exception $e) {
            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
            return $response;
    	}
    }
}
