<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\ProductAlternativeWidget\Widget;

use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\ProductAlternativeWidget\ProductAlternativeWidgetFactory getFactory()
 */
class ProductAlternativeListWidget extends AbstractWidget
{
    /**
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     */
    public function __construct(ProductViewTransfer $productViewTransfer)
    {
        $this->addParameter('products', $this->findAlternativesProducts($productViewTransfer));

        /** @deprecated Use global widgets instead. */
        $this->addWidgets($this->getFactory()->getProductDetailPageProductAlternativeWidgetPlugins());
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'ProductAlternativeListWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@ProductAlternativeWidget/views/product-alternative-list/product-alternative-list.twig';
    }

    /**
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     *
     * @return array<\Generated\Shared\Transfer\ProductViewTransfer>
     */
    protected function findAlternativesProducts(ProductViewTransfer $productViewTransfer): array
    {
        $productAlternativeStorageClient = $this->getFactory()->getProductAlternativeStorageClient();

        if (!$productAlternativeStorageClient->isAlternativeProductApplicable($productViewTransfer)) {
            return [];
        }

        return $productAlternativeStorageClient->getAlternativeProducts($productViewTransfer, $this->getLocale());
    }
}
