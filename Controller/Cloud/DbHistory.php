<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Cloud;

class DbHistory extends \Shirtee\Dropshipping\Controller\Cloud
{
    public function execute()
    {
        $params = $this->getRequest()->getParams();
        
        if (isset($params["table"]) && $params["table"] != "") {
            $block = $this->layoutFactory->create()->createBlock('Shirtee\Dropshipping\Block\DbHistory')->setTemplate("Shirtee_Dropshipping::dbhistory.phtml");
            $block->setTable($params["table"]);

            if (isset($params["page"])) {
                $block->setPage($params["page"]);
            }

            if (isset($params["limit"])) {
                $block->setLimit($params["limit"]);
            }

            $response = $this->getResponse()->setBody($block->toHtml());
            return $response;
        } else {
            $response = $this->getResponse()->setBody(json_encode(["status" => "error", "msg" => "Table must be set."]));
            return $response;
        }
    }
}
