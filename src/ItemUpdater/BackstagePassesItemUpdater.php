<?php

declare(strict_types=1);

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class BackstagePassesItemUpdater implements ItemUpdater
{
    public function update(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
            if ($item->sellIn < 11) {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                }
            }
            if ($item->sellIn < 6) {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                }
            }
        }

        $this->decreaseSellIn($item);
    }

    private function decreaseSellIn(Item $item): void
    {
        $item->sellIn--;
    }
}
