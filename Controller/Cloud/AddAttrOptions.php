<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class AddAttrOptions extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
    	try {
            $post_data = $this->getRequest()->getPostValue();

            $errors = [];
            if (!isset($post_data["attr"])) {
                $errors[] = "attr is required.";
            }
            if (!isset($post_data["options"])) {
                $errors[] = "options are required.";
            }

    		if (count($errors) > 0) {
                $data = ["type" => "ShirteeCloud_AddAttrOptions", "ldata" => ["request" => $post_data, "response" => $errors], "status" => 0, "error" => ""];
                $this->shirteeHelper->doDebug($data);

                $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => implode(", ", $errors)]));
                return $response;
            } else {
                $result = $this->shirteeHelper->addAttributeOptions($post_data["attr"], $post_data["options"]);
            }

            $data = ["type" => "ShirteeCloud_AddAttrOptions", "ldata" => ["request" => $post_data, "response" => $result], "status" => 1, "error" => ""];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode($result));
            return $response;
    	} catch (Exception $e) {
            $data = ["type" => "ShirteeCloud_AddAttrOptions", "ldata" => ["request" => $post_data, "response" => ""], "status" => 0, "error" => $e->getMessage()];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
            return $response;
    	}
    }
}
