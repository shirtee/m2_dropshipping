<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class DoSettings extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
    	try {
            $post_data = $this->getRequest()->getPostValue();
    		$result = $this->shirteeHelper->doSettings($post_data);
            
    		$data = ["type" => "ShirteeCloud_DoSettings", "ldata" => ["request" => $post_data, "response" => $result], "status" => 1, "error" => ""];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode($result));
            return $response;
    	} catch (Exception $e) {
            $data = ["type" => "ShirteeCloud_DoSettings", "ldata" => ["request" => $post_data, "response" => "error"], "status" => 0, "error" => $e->getMessage()];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
            return $response;
    	}
    }
}
