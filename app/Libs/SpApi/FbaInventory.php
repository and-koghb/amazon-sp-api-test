<?php

namespace App\Libs\SpApi;

use AmazonPHP\SellingPartner\Exception\ApiException;
use AmazonPHP\SellingPartner\Marketplace;
use AmazonPHP\SellingPartner\Regions;

class FbaInventory extends Sdk
{
    public function getData(bool $details = false, ?array $skus = null) :array
    {
        $accessToken = $this->sdk->oAuth()->exchangeRefreshToken(self::$config['amazon_sp_api']['credentials']['lwa_refresh_token']);

        $allSkusInventory = [];
        $n = 0;
        $nextToken = '';
        do {
            try {
                $inventory = $this->sdk->FBAInventory()->getInventorySummaries(
                    $accessToken,
                    Regions::NORTH_AMERICA,
                    'Marketplace',
                    Marketplace::US()->id(),
                    [Marketplace::US()->id()],
                    $details,
                    null,
                    $skus,
                    urldecode($nextToken)
                );

                $allSkusInventory = array_merge($allSkusInventory, $inventory['payload']['inventory_summaries'] ?? []);

                $nextToken = $inventory['pagination']['next_token'] ?? null;

                if ($n % 2 == 0) {
                    sleep(1);
                }
                $n ++;
            } catch (ApiException $exception) {
                return [
                    'errors' => $exception->getMessage(),
                    'inventory' => $allSkusInventory
                ];
            };
        } while ($nextToken !== null && $nextToken !== 'seed');

        return [
            'errors' => null,
            'inventory' => $allSkusInventory
        ];
    }
}
