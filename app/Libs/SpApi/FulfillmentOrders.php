<?php

namespace App\Libs\SpApi;

use AmazonPHP\SellingPartner\Exception\ApiException;
use AmazonPHP\SellingPartner\Regions;

class FulfillmentOrders extends Sdk
{
    public function getAll(?\DateTimeInterface $startTime = null) :array
    {
        $accessToken = $this->sdk->oAuth()->exchangeRefreshToken(self::$config['amazon_sp_api']['credentials']['lwa_refresh_token']);

        $allOrders = [];
        $n = 0;
        $nextToken = '';
        do {
            try {
                $orders = $this->sdk->FulfillmentOutbound()->listAllFulfillmentOrders(
                    $accessToken,
                    Regions::NORTH_AMERICA,
                    $startTime,
                    urldecode($nextToken)
                );

                $allOrders = array_merge($allOrders, $orders['payload']['inventory_summaries'] ?? []);

                $nextToken = $orders['pagination']['next_token'] ?? null;

                if ($n % 2 == 0) {
                    sleep(1);
                }
                $n ++;
            } catch (ApiException $exception) {
                return [
                    'errors' => $exception->getMessage(),
                    'orders' => $allOrders
                ];
            };
        } while ($nextToken !== null && $nextToken !== 'seed');

        return [
            'errors' => null,
            'orders' => $allOrders
        ];
    }
}
