<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Builder\ItemUpdaterBuilder;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $itemUpdater = ItemUpdaterBuilder::buildByItemName($item->name);

            $itemUpdater->update($item);
        }
    }
}
