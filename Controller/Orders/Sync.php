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

    		echo json_encode(["status" => "success"]);
    		exit;
    	} catch (Exception $e) {
    		echo json_encode(["status" => "error", "msg" => $e->getMessage()]);
    		exit;
    	}
    }
}
