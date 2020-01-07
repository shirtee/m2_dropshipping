<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Products;

class Update extends \Shirtee\Dropshipping\Controller\Products
{
    public function execute()
    {
    	try {
    		$this->shirteeHelper->cronUpdateProducts();

            $response = $this->getResponse()->setBody(json_encode(["status" => "success"]));
            return $response;
    	} catch (Exception $e) {
            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
            return $response;
    	}
    }
}
