<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class NotifyAddDsProduct extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
    	try {
            $post_data = $this->getRequest()->getPostValue();
            $post_data = $post_data["data"];
    		$result = $this->shirteeHelper->notifyAddDsProduct($post_data);
            
    		$data = ["type" => "ShirteeCloud_NotifyAddDsProduct", "ldata" => ["request" => $post_data, "response" => $result], "status" => 1, "error" => ""];
            $this->shirteeHelper->doDebug($data);
    	} catch (Exception $e) {
            $data = ["type" => "ShirteeCloud_NotifyAddDsProduct", "ldata" => ["request" => $post_data, "response" => "error"], "status" => 0, "error" => $e->getMessage()];
            $this->shirteeHelper->doDebug($data);
    	}
    }
}
