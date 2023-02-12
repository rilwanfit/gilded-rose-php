<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class AgedBrieItemUpdater implements ItemUpdater
{
    public function update(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }
    }
}
