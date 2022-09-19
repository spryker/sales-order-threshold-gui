<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesOrderThresholdGui\Communication\Plugin\FormExpander;

use Generated\Shared\Transfer\SalesOrderThresholdTypeTransfer;
use Generated\Shared\Transfer\SalesOrderThresholdValueTransfer;
use Spryker\Zed\Gui\Communication\Form\Type\FormattedMoneyType;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesOrderThresholdGui\SalesOrderThresholdGuiConfig;
use Spryker\Zed\SalesOrderThresholdGuiExtension\Dependency\Plugin\SalesOrderThresholdFormExpanderPluginInterface;
use Spryker\Zed\SalesOrderThresholdGuiExtension\Dependency\Plugin\SalesOrderThresholdFormFieldDependenciesPluginInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Range;

/**
 * @method \Spryker\Zed\SalesOrderThresholdGui\Communication\SalesOrderThresholdGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\SalesOrderThresholdGui\SalesOrderThresholdGuiConfig getConfig()
 */
class GlobalSoftThresholdFixedFeeFormExpanderPlugin extends AbstractPlugin implements SalesOrderThresholdFormExpanderPluginInterface, SalesOrderThresholdFormFieldDependenciesPluginInterface
{
    /**
     * @var string
     */
    protected const FIELD_SOFT_FIXED_FEE = 'fixedFee';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getThresholdName(): string
    {
        return 'Soft Threshold with fixed fee';
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getThresholdKey(): string
    {
        return SalesOrderThresholdGuiConfig::SOFT_TYPE_STRATEGY_FIXED;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getThresholdGroup(): string
    {
        return SalesOrderThresholdGuiConfig::GROUP_SOFT;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return \Symfony\Component\Form\FormBuilderInterface
     */
    public function expand(FormBuilderInterface $builder, array $options): FormBuilderInterface
    {
        $this->addSoftFixedFeeField($builder, $options);

        return $builder;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SalesOrderThresholdValueTransfer $salesOrderThresholdValueTransfer
     * @param array<string, mixed> $data
     *
     * @return array
     */
    public function mapSalesOrderThresholdValueTransferToFormData(SalesOrderThresholdValueTransfer $salesOrderThresholdValueTransfer, array $data): array
    {
        $data[static::FIELD_SOFT_FIXED_FEE] = $salesOrderThresholdValueTransfer->getFee();

        return $data;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<string, mixed> $data
     * @param \Generated\Shared\Transfer\SalesOrderThresholdValueTransfer $salesOrderThresholdValueTransfer
     *
     * @return \Generated\Shared\Transfer\SalesOrderThresholdValueTransfer
     */
    public function mapFormDataToTransfer(array $data, SalesOrderThresholdValueTransfer $salesOrderThresholdValueTransfer): SalesOrderThresholdValueTransfer
    {
        $salesOrderThresholdValueTransfer->setFee($data[static::FIELD_SOFT_FIXED_FEE])
            ->setSalesOrderThresholdType(
                (new SalesOrderThresholdTypeTransfer())
                    ->setKey($this->getThresholdKey())
                    ->setThresholdGroup($this->getThresholdGroup()),
            );

        return $salesOrderThresholdValueTransfer;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    protected function addSoftFixedFeeField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(static::FIELD_SOFT_FIXED_FEE, FormattedMoneyType::class, [
            'label' => 'Enter fixed fee',
            'currency' => $options[SalesOrderThresholdGuiConfig::OPTION_CURRENCY_CODE],
            'locale' => $options[SalesOrderThresholdGuiConfig::OPTION_LOCALE],
            'divisor' => 100,
            'required' => false,
            'attr' => [
                'threshold_group' => $this->getThresholdGroup(),
                'threshold_key' => $this->getThresholdKey(),
            ],
            'constraints' => [
                new Range(['min' => 0]),
            ],
        ]);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<string>
     */
    public function getThresholdFieldDependentFieldNames(): array
    {
        return [
            static::FIELD_SOFT_FIXED_FEE,
        ];
    }
}
