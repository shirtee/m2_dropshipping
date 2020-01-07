<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class SeeAttribute extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
    	try {
            $params = $this->getRequest()->getParams();
            if (isset($params["attr"]) && $params["attr"] != "") {
                $result = $this->shirteeHelper->getAttribute($params["attr"]);

                $response = $this->getResponse()->setBody(json_encode($result));
                return $response;
            } else {
                $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => "Attribute is not blank."]));
                return $response;
            }
    	} catch (Exception $e) {
            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
            return $response;
    	}
    }
}
