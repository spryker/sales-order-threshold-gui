<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\SalesOrderThresholdGui\Communication\Plugin\Sales;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\SalesOrderThresholdGui\SalesOrderThresholdGuiConfig;
use Spryker\Zed\SalesOrderThresholdGui\Communication\Plugin\Sales\ThresholdExpensesSalesOrderDetailDataExpanderPlugin;
use SprykerTest\Zed\SalesOrderThresholdGui\SalesOrderThresholdGuiCommunicationTester;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group SalesOrderThresholdGui
 * @group Communication
 * @group Plugin
 * @group Sales
 * @group ThresholdExpensesSalesOrderDetailDataExpanderPluginTest
 * Add your own group annotations below this line
 */
class ThresholdExpensesSalesOrderDetailDataExpanderPluginTest extends Unit
{
    protected SalesOrderThresholdGuiCommunicationTester $tester;

    public function testExpandAddsThresholdExpenseType(): void
    {
        // Arrange
        $plugin = $this->getSalesOrderDetailDataExpanderPlugin();
        $orderTransfer = new OrderTransfer();

        // Act
        $result = $plugin->expand($orderTransfer, []);

        // Assert
        $this->assertArrayHasKey('thresholdExpenseType', $result);
        $this->assertSame(SalesOrderThresholdGuiConfig::THRESHOLD_EXPENSE_TYPE, $result['thresholdExpenseType']);
    }

    public function testExpandPreservesExistingData(): void
    {
        // Arrange
        $plugin = $this->getSalesOrderDetailDataExpanderPlugin();
        $orderTransfer = new OrderTransfer();
        $existingData = ['someKey' => 'someValue'];

        // Act
        $result = $plugin->expand($orderTransfer, $existingData);

        // Assert
        $this->assertArrayHasKey('someKey', $result);
        $this->assertArrayHasKey('thresholdExpenseType', $result);
    }

    public function getSalesOrderDetailDataExpanderPlugin(): ThresholdExpensesSalesOrderDetailDataExpanderPlugin
    {
        return new ThresholdExpensesSalesOrderDetailDataExpanderPlugin();
    }
}
