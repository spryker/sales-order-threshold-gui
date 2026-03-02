<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesOrderThresholdGui\Communication\StoreCurrency;

use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\SalesOrderThresholdGui\Dependency\Facade\SalesOrderThresholdGuiToCurrencyFacadeInterface;
use Spryker\Zed\SalesOrderThresholdGui\Dependency\Facade\SalesOrderThresholdGuiToStoreFacadeInterface;
use Spryker\Zed\SalesOrderThresholdGui\SalesOrderThresholdGuiConfig;

class StoreCurrencyFinder implements StoreCurrencyFinderInterface
{
    /**
     * @var \Spryker\Zed\SalesOrderThresholdGui\Dependency\Facade\SalesOrderThresholdGuiToCurrencyFacadeInterface
     */
    protected $currencyFacade;

    /**
     * @var \Spryker\Zed\SalesOrderThresholdGui\Dependency\Facade\SalesOrderThresholdGuiToStoreFacadeInterface
     */
    protected $storeFacade;

    public function __construct(
        SalesOrderThresholdGuiToCurrencyFacadeInterface $currencyFacade,
        SalesOrderThresholdGuiToStoreFacadeInterface $storeFacade
    ) {
        $this->currencyFacade = $currencyFacade;
        $this->storeFacade = $storeFacade;
    }

    public function getCurrencyTransferFromRequestParam(StoreTransfer $storeTransfer, ?string $storeCurrencyRequestParam): CurrencyTransfer
    {
        if (!$storeCurrencyRequestParam) {
            return $this->currencyFacade->fromIsoCode(current($storeTransfer->getAvailableCurrencyIsoCodes()));
        }

        [, $currencyCode] = explode(
            SalesOrderThresholdGuiConfig::STORE_CURRENCY_DELIMITER,
            $storeCurrencyRequestParam,
        );

        return $this->currencyFacade->fromIsoCode($currencyCode);
    }

    public function getStoreTransferFromRequestParam(?string $storeCurrencyRequestParam): StoreTransfer
    {
        if (!$storeCurrencyRequestParam) {
            return $this->storeFacade->getCurrentStore(true);
        }

        [$storeName] = explode(
            SalesOrderThresholdGuiConfig::STORE_CURRENCY_DELIMITER,
            $storeCurrencyRequestParam,
        );

        return $this->storeFacade->getStoreByName($storeName);
    }
}
