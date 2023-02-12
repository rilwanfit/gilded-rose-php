<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class SulfurasItemUpdater implements ItemUpdater
{
    public function update(Item $item): void
    {
        // "Sulfuras", being a legendary item, never has to be sold or decreases in Quality.
    }
}
