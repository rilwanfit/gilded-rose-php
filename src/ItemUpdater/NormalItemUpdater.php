<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class NormalItemUpdater implements ItemUpdater
{
    public function update(Item $item): void
    {
        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }

        $this->decreaseSellIn($item);
    }

    private function decreaseSellIn(Item $item): void
    {
        $item->sellIn--;
    }
}
