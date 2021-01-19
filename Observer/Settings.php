<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class Settings implements ObserverInterface
{
    public $shirteeHelper;
    public $scopeConfig;

    public function __construct(
        \Shirtee\Dropshipping\Helper\Data $shirteeHelper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->shirteeHelper = $shirteeHelper;
        $this->scopeConfig = $scopeConfig;
    }

    public function execute(EventObserver $observer)
    {
        $post_data = [];
        $post_data["username"] = $this->scopeConfig->getValue('shirtee/settings/username');
        $post_data["password"] = $this->scopeConfig->getValue('shirtee/settings/password');

        $groups = $this->shirteeHelper->request->getPost('groups');
        if (is_array($groups)) {
            foreach ($groups["settings"]["fields"] as $key => $value) {
                if (isset($value["value"])) {
                    $post_data[$key] = $value["value"];
                }
            }
        }

        $website_id = $observer->getEvent()->getWebsite();
        if ($website_id) {
            $post_data["website_id"] = $website_id;
            $post_data["website_url"] = $this->scopeConfig->getValue('web/secure/base_url', \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE, $website_id);

            $access_token = $this->scopeConfig->getValue('shirtee/settings/access_token', \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE, $website_id);
            if (!$access_token) {
                $access_token = $this->shirteeHelper->oauthHelper->generateRandomString(32);
                $this->shirteeHelper->configWriter->save("shirtee/settings/access_token", $access_token, "websites", $website_id);
            }
            
            $this->shirteeHelper->access_token = $access_token;
        } else {
            $post_data["website_url"] = $this->scopeConfig->getValue('web/secure/base_url');
        }

        if (isset($post_data["cid"]) && $post_data["cid"] != "") {
            $this->shirteeHelper->messageManager->getMessages(true);
        }

        $is_dropshipping = $this->scopeConfig->getValue('shirtee/settings/is_dropshipping');
        if ($is_dropshipping == "") {
            $this->shirteeHelper->configWriter->save("shirtee/settings/is_dropshipping", 1, "default", 0);
            $post_data["is_dropshipping"] = 1;
        } else {
            $post_data["is_dropshipping"] = $is_dropshipping;
        }

        $designer_id = $this->scopeConfig->getValue('shirtee/settings/designer_id');
        if ($designer_id == "") {
            $this->shirteeHelper->configWriter->save("shirtee/settings/designer_id", 0, "default", 0);
            $post_data["designer_id"] = 0;
        } else {
            $post_data["designer_id"] = $designer_id;
        }

        $cloud_id = $this->scopeConfig->getValue('shirtee/settings/cloud_id');
        if ($cloud_id == "") {
            $this->shirteeHelper->configWriter->save("shirtee/settings/cloud_id", 0, "default", 0);
            $post_data["cloud_id"] = 0;
        } else {
            $post_data["cloud_id"] = $cloud_id;
        }

        $is_product_custom_info = $this->scopeConfig->getValue('shirtee/settings/is_product_custom_info');
        if ($is_product_custom_info == "") {
            $this->shirteeHelper->configWriter->save("shirtee/settings/is_product_custom_info", 0, "default", 0);
            $post_data["is_product_custom_info"] = 0;
        } else {
            $post_data["is_product_custom_info"] = $is_product_custom_info;
        }

        $product_update_exclude = $this->scopeConfig->getValue('shirtee/settings/product_update_exclude');
        if ($product_update_exclude == "") {
            $this->shirteeHelper->configWriter->save("shirtee/settings/product_update_exclude", "name,short_description,description,images,meta_title,meta_description,meta_keyword", "default", 0);
            $post_data["product_update_exclude"] = "name,short_description,description,images,meta_title,meta_description,meta_keyword";
        } else {
            $post_data["product_update_exclude"] = $product_update_exclude;
        }

        $this->shirteeHelper->notifyShirteeCloud("do_settings", $post_data);
    }
}
