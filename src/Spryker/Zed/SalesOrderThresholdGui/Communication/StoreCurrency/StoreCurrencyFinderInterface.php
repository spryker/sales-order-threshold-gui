<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesOrderThresholdGui\Communication\StoreCurrency;

use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\StoreTransfer;

interface StoreCurrencyFinderInterface
{
    public function getStoreTransferFromRequestParam(?string $storeCurrencyRequestParam): StoreTransfer;

    public function getCurrencyTransferFromRequestParam(StoreTransfer $storeTransfer, ?string $storeCurrencyRequestParam): CurrencyTransfer;
}
