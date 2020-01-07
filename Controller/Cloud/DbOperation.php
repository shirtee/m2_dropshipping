<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class DbOperation extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
        try {
            $post_data = $this->getRequest()->getPostValue();
            
            $errors = [];
            if (!isset($post_data["table"])) {
                $errors[] = "table is required.";
            }
            if (!isset($post_data["type"])) {
                $errors[] = "type is required.";
            }
            if (!isset($post_data["field"])) {
                $errors[] = "field is required.";
            }
            if (!isset($post_data["value"])) {
                $errors[] = "value is required.";
            }
            if (!isset($post_data["odata"])) {
                $errors[] = "odata is required.";
            }

            if (count($errors) > 0) {
                $data = ["type" => "ShirteeCloud_DbOperation", "ldata" => ["request" => $post_data, "response" => $errors], "status" => 0, "error" => ""];
                $this->shirteeHelper->doDebug($data);

                $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => implode(", ", $errors)]));
                return $response;
            } else {
                $result = $this->shirteeHelper->doDbOperation($post_data);
            }

            $data = ["type" => "ShirteeCloud_DbOperation", "ldata" => ["request" => $post_data, "response" => $result], "status" => 1, "error" => ""];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode($result));
            return $response;
        } catch (Exception $e) {
            $data = ["type" => "ShirteeCloud_DbOperation", "ldata" => ["request" => $post_data, "response" => ""], "status" => 0, "error" => $e->getMessage()];
            $this->shirteeHelper->doDebug($data);

            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => $e->getMessage()]));
            return $response;
        }
    }
}
