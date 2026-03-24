<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesOrderThresholdGui\Communication\Plugin\Sales;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\SalesOrderThresholdGui\SalesOrderThresholdGuiConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\SalesOrderDetailDataExpanderPluginInterface;

/**
 * @method \Spryker\Zed\SalesOrderThresholdGui\Communication\SalesOrderThresholdGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\SalesOrderThresholdGui\SalesOrderThresholdGuiConfig getConfig()
 */
class ThresholdExpensesSalesOrderDetailDataExpanderPlugin extends AbstractPlugin implements SalesOrderDetailDataExpanderPluginInterface
{
    protected const string KEY_THRESHOLD_EXPENSE_TYPE = 'thresholdExpenseType';

    /**
     * {@inheritDoc}
     * - Expands order detail data with threshold expense type constant.
     * - Adds `thresholdExpenseType` for threshold expense identification in templates.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param array<string, mixed> $orderDetailData
     *
     * @return array<string, mixed>
     */
    public function expand(OrderTransfer $orderTransfer, array $orderDetailData): array
    {
        $orderDetailData[static::KEY_THRESHOLD_EXPENSE_TYPE] = SalesOrderThresholdGuiConfig::THRESHOLD_EXPENSE_TYPE;

        return $orderDetailData;
    }
}
