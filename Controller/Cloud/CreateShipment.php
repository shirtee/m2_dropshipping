<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class CreateShipment extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
    	try {
            $post_data = $this->getRequest()->getPostValue();
            
            $errors = [];
            if (!isset($post_data["shirtee_oid"])) {
                $errors[] = "shirtee_oid is required.";
            }
            if (!isset($post_data["tracking_number"])) {
                $errors[] = "tracking_number is required.";
            }
            if (!isset($post_data["tracking_title"])) {
                $errors[] = "tracking_title is required.";
            }
            if (!isset($post_data["tracking_carrier"])) {
                $errors[] = "tracking_carrier is required.";
            }

            if (!isset($post_data["comment_text"])) {
                $post_data["comment_text"] = __("Your order has been shipped.");
            }
            if (!isset($post_data["comment_customer_notify"])) {
                $post_data["comment_customer_notify"] = 1;
            }
            if (!isset($post_data["is_visible_on_front"])) {
                $post_data["is_visible_on_front"] = 1;
            }
            if (!isset($post_data["send_email"])) {
                $post_data["send_email"] = 1;
            }

    		if (count($errors) > 0) {
                $data = ["type" => "ShirteeCloud_CreateShipment", "ldata" => ["request" => $post_data, "response" => $errors], "status" => 0, "error" => ""];
                $this->shirteeHelper->doDebug($data);

                $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => implode(", ", $errors)]));
                return $response;
            } else {
                $result = $this->shirteeHelper->createShipment($post_data);
            }

            $data = ["type" => "ShirteeCloud_CreateShipment", "ldata" => ["request" => $post_data, "response" => $result], "status" => 1, "error" => ""];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode($result));
            return $response;
    	} catch (Exception $e) {
            $data = ["type" => "ShirteeCloud_CreateShipment", "ldata" => ["request" => $post_data, "response" => ""], "status" => 0, "error" => $e->getMessage()];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
            return $response;
    	}
    }
}
