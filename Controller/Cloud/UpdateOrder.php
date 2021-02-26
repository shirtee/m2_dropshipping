<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class UpdateOrder extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
    	try {
            $post_data = $this->getRequest()->getParams();
            
            $errors = [];
            if (!isset($post_data["order_id"])) {
                $errors[] = "order id is required.";
            }

            if (count($errors) > 0) {
                $data = ["type" => "ShirteeCloud_UpdateOrder", "ldata" => ["request" => $post_data, "response" => $errors], "status" => 0, "error" => ""];
                $this->shirteeHelper->doDebug($data);

                $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => implode(", ", $errors)]));
                return $response;
            } else {
                $result = $this->shirteeHelper->updateMagentoOrder($post_data);
            }

            $data = ["type" => "ShirteeCloud_UpdateOrder", "ldata" => ["request" => $post_data, "response" => $result], "status" => 1, "error" => ""];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode($result));
            return $response;
        } catch (Exception $e) {
            $data = ["type" => "ShirteeCloud_UpdateOrder", "ldata" => ["request" => $post_data, "response" => ""], "status" => 0, "error" => $e->getMessage()];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
            return $response;
        }
    }
}
